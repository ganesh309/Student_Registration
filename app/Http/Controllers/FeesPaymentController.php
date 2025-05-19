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

        // Build the list with start_date & end_date
        $feesList   = collect();
        $structures = DB::table('fees_structure')
            ->join('semesters', 'fees_structure.semester_id', '=', 'semesters.id')
            ->select(
                'fees_structure.id          as structure_id',
                'fees_structure.total_amount',
                'semesters.semester_no      as semester_name'
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
                $feesList->push((object)[
                    'structure_id'   => $structure->structure_id,
                    'schedule_id'    => $schedule->id,
                    'semester_name'  => $structure->semester_name,
                    'total_amount'   => $structure->total_amount,
                    'start_date'     => $schedule->start_date,
                    'end_date'       => $schedule->end_date,    // ← include end_date
                ]);
            }
        }

        // Which structures already paid?
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

        // find schedule
        $schedule = DB::table('fees_payment_schedules')->where('id', $scheduleId)->first();
        if (! $schedule) {
            return back()->withErrors('Invalid schedule');
        }

        // find structure
        $structure = DB::table('fees_structure')
            ->where('id', $schedule->fees_structure_id)
            ->first();

        // 1) insert into payment_table
        $paymentId = DB::table('payment_table')->insertGetId([
            'student_id'         => $studentId,
            'fees_structure_id'  => $structure->id,
            'total_amount'       => $structure->total_amount,
            'payment_date'       => Carbon::today()->toDateString(),
        ]);

        // 2) fetch all fee heads for this structure
        $feeDetails = DB::table('fees_details')
            ->where('fees_structure_id', $structure->id)
            ->get();

        // 3) insert each into payment_details
        foreach ($feeDetails as $fd) {
            DB::table('payment_details')->insert([
                'payment_table_id' => $paymentId,
                'fees_head_id'     => $fd->fees_head_id,
                'amount'           => $fd->amount,
            ]);
        }

        return redirect()
               ->route('students.fees')
               ->with('success', 'Payment successful.');
    }
}
