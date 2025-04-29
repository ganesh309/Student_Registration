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
        // Validate input based on your table structure
        $request->validate([
            'fees_head_id'   => 'required|array',
            'fees_head_id.*' => 'exists:fees_heads,id',
            'amount'         => 'required|array',
            'amount.*'       => 'numeric|min:0',
            'course_id'      => 'required|exists:course,id', // Use 'course' here
            'academic_id'    => 'required|exists:academic_years,id',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Step 1: Create or get the fees structure
            $feesStructure = FeesStructure::firstOrCreate(
                [
                    'course_id'   => $request->course_id,
                    'academic_id' => $request->academic_id,
                ],
                [
                    'total_amount' => 0, // Temporary; will be updated
                ]
            );
    
            $totalAmount = 0;
    
            // Step 2: Loop through fees and create detail records
            foreach ($request->fees_head_id as $index => $headId) {
                $amount = $request->amount[$index];
    
                FeesDetail::create([
                    'fees_structure_id' => $feesStructure->id,
                    'fees_head_id'      => $headId,
                    'amount'            => $amount,
                ]);
    
                $totalAmount += $amount;
            }
    
            // Step 3: Update the total amount in the structure
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


}
