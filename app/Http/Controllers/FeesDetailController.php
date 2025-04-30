<?php

namespace App\Http\Controllers;

use App\Models\FeesHead;
use App\Models\FeesDetail;
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
            $feesStructure = FeesStructure::firstOrCreate(
                [
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
    

    $feesStructures = $query->paginate($request->get('per_page', 5));

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
    $semesters = Semester::all(); // Add this line
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

 
    $totalAmount = array_sum($amounts);
    $feesStructure->update([
        'course_id'    => $request->input('course_id'),
        'semester_id'  => $request->input('semester_id'),
        'academic_id'  => $request->input('academic_id'),
        'total_amount' => $totalAmount,
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



}
