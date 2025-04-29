<?php

namespace App\Http\Controllers;

use App\Models\FeesHead;
use App\Models\FeesDetail;
use App\Models\FeesStructure;
use App\Models\Course;
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

        return view('fees_details.create', compact('feesHeads', 'courses', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fees_head_id'   => 'required|array',
            'fees_head_id.*' => 'exists:fees_heads,id',
            'amount'         => 'required|array',
            'amount.*'       => 'numeric|min:0',
            'course_id'      => 'required|exists:course,id',
            'academic_id'    => 'required|exists:academic_years,id',
        ]);
    
        DB::beginTransaction();
    
        try {
            $feesStructure = FeesStructure::firstOrCreate(
                [
                    'course_id'   => $request->course_id,
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

            return redirect()->back()->with('success', 'Fees assigned successfully.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }

//-----------------------------------edit--------------------------------------//

public function edit()
{
    // Get all courses and academic years for the dropdowns
    $courses = Course::all();
    $academicYears = AcademicYear::all();

    return view('fees_details.edit', compact('courses', 'academicYears'));
}

// Get the fees breakdown for a specific course and academic year
public function getFeesDetails(Request $request)
{
    $feesDetails = FeesDetail::where('course_id', $request->course_id)
        ->where('academic_id', $request->academic_id)
        ->get();

    // Return the fees data as JSON
    return response()->json($feesDetails);
}

public function update(Request $request)
{
    // Loop through the updated fees and update each one
    foreach ($request->updated_fees as $updatedFee) {
        $fee = FeesDetail::find($updatedFee['fee_id']);
        $fee->amount = $updatedFee['amount'];
        $fee->save();
    }

    return response()->json(['status' => 'success']);
}



}
