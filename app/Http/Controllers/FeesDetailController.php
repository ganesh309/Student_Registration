<?php

namespace App\Http\Controllers;

use App\Models\FeesHead;
use App\Models\FeesDetail;
use App\Models\FeesPaymentSchedule;
use App\Models\FeesStructure;
use App\Models\Course;
use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesDetailController extends Controller
{
    public function create()
    {
        $feesHeads = FeesHead::all();
        $courses = Course::all();
        $academicYears = AcademicYear::all();
        $semesters = Semester::all();
        return view('fees_details.create', compact('feesHeads', 'courses', 'academicYears', 'semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fees_head_id'   => 'required|array',
            'fees_head_id.*' => 'exists:fees_heads,id',
            'amount'         => 'required|array',
            'amount.*'       => 'numeric|min:0',
            'course_id'      => 'required|exists:course,id',
            'semester_id'    => 'required|exists:semesters,id',
            'academic_id'    => 'required|exists:academic_years,id',
        ]);
    
        DB::beginTransaction();
    
        try {
            $courseName   = Course::findOrFail($request->course_id)->course_name;
            $semesterNo   = Semester::findOrFail($request->semester_id)->semester_no;
            $academicYear = AcademicYear::findOrFail($request->academic_id)->academic_year;
    
            $structureName = "{$courseName} {$semesterNo} sem {$academicYear}";
            $feesStructure = FeesStructure::firstOrCreate(
                [
                    'structure_name' => $structureName,
                    'course_id'   => $request->course_id,
                    'semester_id'    => $request->semester_id,
                    'academic_id' => $request->academic_id,
                ],
                [
                    'total_amount' => 0,
                ]
            );
    
            $totalAmount = 0;
    
            foreach ($request->fees_head_id as $index => $headId) {
                $amount = $request->amount[$index];
    
                FeesDetail::create([
                    'fees_structure_id' => $feesStructure->id,
                    'fees_head_id'      => $headId,
                    'amount'            => $amount,
                ]);
    
                $totalAmount += $amount;
            }
    
            $feesStructure->update([
                'total_amount' => $totalAmount
            ]);
    
            DB::commit();

            return redirect()->route('fees-details.list')->with('success', 'Fees assigned successfully.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
//-------------------------------------fees list-------------------------------//

public function list(Request $request)
{
    $query = FeesStructure::with([
        'feesDetails.feesHead',
        'academicYear:id,academic_year',
        'course:id,course_name',
        'semester:id,semester_no',
    ])->orderBy('created_at', 'desc');

    if ($request->filled('course_id')) {
        $query->where('course_id', $request->course_id);
    }
    if ($request->filled('semester_id')) {
        $query->where('semester_id', $request->semester_id);
    }
    if ($request->filled('academic_id')) {
        $query->where('academic_id', $request->academic_id);
    }
    if ($request->filled('min_amount') && $request->filled('max_amount')) {
        $query->whereBetween('total_amount', [
            $request->input('min_amount'), 
            $request->input('max_amount')
        ]);
    }

    if ($request->filled('search')) {
        $searchTerm = $request->search;

        $query->where(function ($q) use ($searchTerm) {
            $q->whereHas('course', function ($sub) use ($searchTerm) {
                $sub->where('course_name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('academicYear', function ($sub) use ($searchTerm) {
                $sub->where('academic_year', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('semester', function ($sub) use ($searchTerm) {
                $sub->where('semester_no', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('feesDetails.feesHead', function ($sub) use ($searchTerm) {
                $sub->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhereHas('feesDetails', function ($sub) use ($searchTerm) {
                $sub->where('amount', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orWhere('total_amount', 'LIKE', '%' . $searchTerm . '%');
        });
    }

    $feesStructures = $query->paginate($request->get('per_page', 5))->withQueryString();

    $courses = Course::all();
    $semesters = Semester::all();
    $academicYears = AcademicYear::all();
    $feesHeads = FeesHead::all();

    return view('fees_details.details', compact('feesStructures', 'courses', 'semesters', 'academicYears', 'feesHeads'));
}



//-----------------------------------edit--------------------------------------//
public function edit($id)
{
    $feesStructure = FeesStructure::with('feesDetails')->findOrFail($id);
    $courses = Course::all();
    $semesters = Semester::all();
    $academicYears = AcademicYear::all();
    $feesHeads = FeesHead::all();

    return view('fees_details.edit', compact(
        'feesStructure', 
        'courses', 
        'semesters', 
        'academicYears', 
        'feesHeads'
    ));
}


public function update(Request $request, $id)
{
    $feesStructure = FeesStructure::findOrFail($id);

    $headIds = $request->input('fees_head_id', []);
    $amounts = $request->input('amount', []);

    $courseName   = Course::findOrFail($request->course_id)->course_name;
    $semesterNo   = Semester::findOrFail($request->semester_id)->semester_no;
    $academicYear = AcademicYear::findOrFail($request->academic_id)->academic_year;

    $structureName = "{$courseName} {$semesterNo} sem {$academicYear}";
    $totalAmount = array_sum($amounts);
    $feesStructure->update([
        'course_id'    => $request->input('course_id'),
        'semester_id'  => $request->input('semester_id'),
        'academic_id'  => $request->input('academic_id'),
        'total_amount' => $totalAmount,
        'structure_name' => $structureName,
    ]);

    $feesStructure->feesDetails()->delete();
    foreach ($headIds as $index => $headId) {
        $feesStructure->feesDetails()->create([
            'fees_head_id' => $headId,
            'amount'       => $amounts[$index],
        ]);
    }
    return redirect()->route('fees-details.list')->with('success', 'Fees details updated successfully.');
}



public function print($id)
{
    $feesStructure = FeesStructure::with('feesDetails')->findOrFail($id);
    return view('fees_details.print', compact('feesStructure'));
}



public function head(Request $request)
{
    $query = FeesHead::query();

    if ($request->has('search') && $request->search) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    $feesheads = $query->orderBy('created_at', 'desc')->get();

    foreach ($feesheads as $head) {
        $head->deletable = !\DB::table('fees_details')->where('fees_head_id', $head->id)->exists();
    }

    return view('fees_details.feeshead', compact('feesheads'));
}





public function storeHead(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    if (FeesHead::where('name', $request->name)->exists()) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Fees Head already exists.');
    }

    FeesHead::create($request->only('name', 'description'));

    return redirect()->route('fees-heads.list')->with('success', 'Fees Head created successfully.');
}



public function updateHead(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    if (FeesHead::where('name', $request->name)->where('id', '!=', $id)->exists()) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Fees Head already exists.');
    }

    $head = FeesHead::findOrFail($id);
    $head->update($request->only('name', 'description'));

    return redirect()->route('fees-heads.list')->with('success', 'Fees Head updated successfully.');
}


public function destroyHead($id)
{
    FeesHead::findOrFail($id)->delete();

    return redirect()->route('fees-heads.list')->with('success', 'Fees Head deleted successfully.');
}



//-----------------------------------------------fees-payment-schedule---------------------------------------//

public function paymentSchedule()
{
 
    $structures=FeesStructure::all();
    $courses = Course::all();
    $semesters = Semester::all();
    $academicYears = AcademicYear::all();
    return view('fees_details.feesPaymentSchedule', compact('structures','courses','semesters','academicYears'));
}


public function checkFeesStructure(Request $request)
{
    $academicId = $request->academic_id;
    $courseId = $request->course_id;
    $semesterId = $request->semester_id;

    $structure = DB::table('fees_structure')
        ->where('academic_id', $academicId)
        ->where('course_id', $courseId)
        ->where('semester_id', $semesterId)
        ->first();

    if ($structure) {
        $alreadyScheduled = DB::table('fees_payment_schedules')
            ->where('fees_structure_id', $structure->id)
            ->exists();

        return response()->json([
            'exists' => true,
            'total_amount' => $structure->total_amount,
            'scheduled' => $alreadyScheduled,
        ]);
    } else {
        return response()->json(['exists' => false]);
    }
}


public function feesScheduleStore(Request $request)
{
    $request->validate([
        'academic_id' => 'required',
        'course_id' => 'required',
        'semester_id' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'extended_date' => 'nullable|date',
        'late_fine' => 'nullable|numeric|min:0',
        'payment' => 'required|numeric|min:0',
        'description' => 'nullable|string|max:255',
    ]);

    $feesStructure = FeesStructure::where('academic_id', $request->academic_id)
        ->where('course_id', $request->course_id)
        ->where('semester_id', $request->semester_id)
        ->first();

    if (!$feesStructure) {
        return back()->with('error', 'No corresponding fee structure found.');
    }

    $existingSchedule = FeesPaymentSchedule::where('fees_structure_id', $feesStructure->id)->first();
    if ($existingSchedule) {
        return back()->with('error', 'Payment already scheduled for this structure.');
    }

    FeesPaymentSchedule::create([
        'fees_structure_id' => $feesStructure->id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'extended_date' => $request->extended_date,
        'late_fine' => $request->late_fine,
        'description' => $request->description,
    ]);

    return redirect()->route('fees-schedules.list')->with('success', 'Fees Payment Schedule saved successfully!');
}


public function scheduleList(Request $request)
{
    $courses = Course::all();
    $academicYears = AcademicYear::all();
    $semesters = Semester::all();

    $query = FeesPaymentSchedule::with('structure');

    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->whereHas('structure', function ($subQuery) use ($search) {
                $subQuery->where('structure_name', 'like', "%{$search}%");
            })
            ->orWhere('description', 'like', "%{$search}%")
            ->orWhere('late_fine', 'like', "%{$search}%")
            ->orWhereDate('start_date', $search)
            ->orWhereDate('end_date', $search);
        });
    }

    if ($request->filled('start_date')) {
        $query->whereDate('start_date', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('end_date', '<=', $request->end_date);
    }

    if ($request->filled('course_id') || $request->filled('semester_id') || $request->filled('academic_id')) {
        $query->whereHas('structure', function ($q) use ($request) {
            if ($request->filled('course_id')) {
                $q->where('course_id', $request->course_id);
            }
            if ($request->filled('semester_id')) {
                $q->where('semester_id', $request->semester_id);
            }
            if ($request->filled('academic_id')) {
                $q->where('academic_id', $request->academic_id);
            }
        });
    }

    $perPage = $request->input('per_page', 5);
    $schedules = $query->orderBy('start_date', 'desc')
                       ->paginate($perPage)
                       ->appends($request->all());

    return view('fees_details.fees_schedule_list', compact('schedules', 'courses', 'academicYears', 'semesters'));
}



public function editSchedule($id)
{
    $feesPaymentSchedule = FeesPaymentSchedule::with('structure.academicYear', 'structure.course', 'structure.semester')
    ->findOrFail($id);

    $academicYears = AcademicYear::all();
    $courses = Course::all();
    $semesters = Semester::all();

    return view('fees_details.fees-schedule-edit', compact('feesPaymentSchedule', 'academicYears', 'courses', 'semesters'));
}


public function updateSchedule(Request $request, $id)
{
    $schedule = FeesPaymentSchedule::findOrFail($id);

    $schedule->update([
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'extended_date' => $request->extended_date,
        'late_fine' => $request->late_fine,
        'description' => $request->description,
    ]);
    return redirect()->route('fees-schedules.list')->with('success', 'Payment schedule updated successfully.');
}


}
