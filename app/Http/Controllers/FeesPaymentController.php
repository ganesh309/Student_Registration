<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeesPaymentController extends Controller
{
   public function paymentFees(Request $request)
{
    $studentId = session('student_id');
    if (! $studentId) {
        return redirect()->route('student.login');
    }

    $student  = Student::findOrFail($studentId);
    $yearId   = $student->academic_id;
    $courseId = $student->current_course_id;
    $feesList = collect();

    // Get the fees_head_id for "Late Fine"
    $lateFineHead = DB::table('fees_heads')->where('name', 'Late Fine')->first();
    $lateFineHeadId = $lateFineHead->id ?? null;

    // Get all fees structures
    $structures = DB::table('fees_structure')
        ->join('semesters', 'fees_structure.semester_id', '=', 'semesters.id')
        ->select(
            'fees_structure.id as structure_id',
            'fees_structure.total_amount',
            'semesters.semester_no as semester_name'
        )
        ->where('fees_structure.academic_id', $yearId)
        ->where('fees_structure.course_id', $courseId)
        ->get();

    foreach ($structures as $structure) {
        $schedules = DB::table('fees_payment_schedules')
            ->where('fees_structure_id', $structure->structure_id)
            ->orderBy('start_date')
            ->get();

        foreach ($schedules as $schedule) {
            $startDate     = \Carbon\Carbon::parse($schedule->start_date);
            $actualEndDate = \Carbon\Carbon::parse($schedule->extended_date ?? $schedule->end_date);
            $today         = \Carbon\Carbon::today();

            $lateFine = 0;
            $totalAmount = $structure->total_amount;

            // Check if student has paid this structure
            $payment = DB::table('payment_table')
                ->where('student_id', $studentId)
                ->where('fees_structure_id', $structure->structure_id)
                ->first();

            if ($payment) {
                // Fetch the late fine from payment_details where fees_head_id = late fine
                $lateFineDetail = DB::table('payment_details')
                    ->where('payment_table_id', $payment->id)
                    ->where('fees_head_id', $lateFineHeadId)
                    ->first();

                $lateFine = $lateFineDetail->amount ?? 0;
                $totalAmount = $payment->total_amount ?? ($structure->total_amount + $lateFine);
            } else {
                // Calculate late fine if not paid
                if ($today->gt($actualEndDate)) {
                    $daysLate = $today->diffInDays($actualEndDate);
                    $lateFine = $daysLate * $schedule->late_fine;
                }
                $totalAmount = $structure->total_amount + $lateFine;
            }

            $feesList->push((object)[
                'structure_id'   => $structure->structure_id,
                'schedule_id'    => $schedule->id,
                'semester_name'  => $structure->semester_name,
                'start_date'     => $schedule->start_date,
                'end_date'       => $actualEndDate->format('Y-m-d'),
                'late_fine'      => $lateFine,
                'amount'         => $structure->total_amount,
                'total_amount'   => $totalAmount,
            ]);
        }
    }

    $paidStructures = DB::table('payment_table')
        ->where('student_id', $studentId)
        ->pluck('fees_structure_id')
        ->toArray();

    return view('students-fees', compact('feesList', 'paidStructures'));
}





   public function payFees(Request $request)
{
    $request->validate([
        'schedule_id' => 'required|integer',
    ]);

    $studentId  = session('student_id');
    $scheduleId = $request->input('schedule_id');

    $schedule = DB::table('fees_payment_schedules')->where('id', $scheduleId)->first();
    if (! $schedule) {
        return back()->withErrors('Invalid schedule');
    }

    $structure = DB::table('fees_structure')
        ->where('id', $schedule->fees_structure_id)
        ->first();

    $actualEndDate = \Carbon\Carbon::parse($schedule->extended_date ?? $schedule->end_date);
    $today = \Carbon\Carbon::today();

    $lateFine = 0;
    if ($today->gt($actualEndDate)) {
        $daysLate = $today->diffInDays($actualEndDate);
        $lateFine = $daysLate * $schedule->late_fine;
    }
    $totalAmount = $structure->total_amount + $lateFine;

    $year = date('Y');
    $paymentCount = DB::table('payment_table')
        ->whereYear('payment_date', $year)
        ->count();
    $nextNumber = str_pad($paymentCount + 1, 4, '0', STR_PAD_LEFT);
    $paymentReceipt = 'RECPT' . $year . $nextNumber;

    $paymentId = DB::table('payment_table')->insertGetId([
        'student_id'         => $studentId,
        'fees_structure_id'  => $structure->id,
        'total_amount'       => $totalAmount,
        'payment_date'       => $today->toDateString(),
        'payment_receipt'    => $paymentReceipt,
    ]);

    $feeDetails = DB::table('fees_details')
        ->where('fees_structure_id', $structure->id)
        ->get();

    foreach ($feeDetails as $fd) {
        DB::table('payment_details')->insert([
            'payment_table_id' => $paymentId,
            'fees_head_id'     => $fd->fees_head_id,
            'amount'           => $fd->amount,
        ]);
    }

    if ($lateFine > 0) {
        $lateFineHead = DB::table('fees_heads')
            ->where('name', 'Late Fine')
            ->first();

        if ($lateFineHead) {
            DB::table('payment_details')->insert([
                'payment_table_id' => $paymentId,
                'fees_head_id'     => $lateFineHead->id,
                'amount'           => $lateFine,
            ]);
        }
    }

    return redirect()
           ->route('students.fees')
           ->with('success', 'Payment successful.');
}




  public function printInvoice($structure_id)
{
    $studentId = session('student_id');

    $payment = DB::table('payment_table')
        ->where('fees_structure_id', $structure_id)
        ->where('student_id', $studentId)
        ->first();

    if (!$payment) {
        abort(404, 'Payment not found');
    }

    $student = DB::table('students')->where('id', $studentId)->first();
    $paymentDetails = DB::table('payment_details')
        ->where('payment_table_id', $payment->id)
        ->get();

    $feeBreakdown = $paymentDetails->map(function ($detail) {
        $feeHead = DB::table('fees_heads')->where('id', $detail->fees_head_id)->first();
        return [
            'name' => $feeHead ? $feeHead->name : 'Unknown',
            'amount' => $detail->amount
        ];
    });

    $totalAmount = $feeBreakdown->sum('amount');

    $courseName = DB::table('course')->where('id', $student->current_course_id)->value('course_name') ?? 'N/A';
    $semesterId = DB::table('fees_structure')->where('id', $structure_id)->value('semester_id');
    $semesterName = $semesterId ? DB::table('semesters')->where('id', $semesterId)->value('semester_no') : 'N/A';

    return view('invoice-print', compact('payment', 'feeBreakdown', 'totalAmount', 'student', 'semesterName', 'courseName'));
}
}