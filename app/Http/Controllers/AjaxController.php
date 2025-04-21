<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use App\Models\School;
use App\Models\Course;
use App\Models\Specialization;

class AjaxController extends Controller
{
    public function getSchools()
    {
        $schools = School::getAllSchools();
        $options ="<option value=''>University Name</option>";
        
        foreach ($schools as $school){
            $options .="<option value='{$school->id}'>{$school->school_name}</option>";
        }

        return $options;
        // return response()->json($options);
    }

    // Fetch courses for the first dropdown
    public function getCourses()
    {
        $courses = Course::getAllCourses();
        $options ="<option value=''>Select</option>";
        
        foreach ($courses as $course){
            $options .="<option value='{$course->id}'>{$course->course_name}</option>";
        }

        return $options;
    }

    // Fetching specializations based on selected course_id
    public function getSpecializations($course_id)
    {
        if ($course_id) {
            $specializations = Specialization::getAllSpecialization($course_id);
    
            if ($specializations->isEmpty()) {
                return response()->json(['message' => 'No specializations found for this course'], 404);
            }
    
            $options = "<option value=''>Select</option>";
    
            foreach ($specializations as $specialization) {
                $options .= "<option value='{$specialization->id}'>{$specialization->specialization_name}</option>";
            }
    
            return $options;
        }
    
        return response()->json(['message' => 'specializations not found'], 404);
    }


    // Fetch countries for the first dropdown
    public function getCountries()
    {
        $countries = Country::getAllCountries();
        $options ="<option value=''>Select</option>";
        
        foreach ($countries as $country){
            $options .="<option value='{$country->id}'>{$country->country_name}</option>";
        }

        return $options;
        // return response()->json($options);
    }

    // Fetching states based on selected country_id
    public function getStates($country_id)
    {
        if ($country_id) {
            $states = State::getAllStates($country_id);
    
            if ($states->isEmpty()) {
                return response()->json(['message' => 'No states found for this country'], 404);
            }
    
            $options = "<option value=''>Select</option>";
    
            foreach ($states as $state) {
                $options .= "<option value='{$state->id}'>{$state->state_name}</option>";
            }
    
            return $options;
            // return response()->json($options);
        }
    
        return response()->json(['message' => 'states not found'], 404);
    }
    

    // Fetching districts based on selected state_id
    public function getDistricts($state_id)
    {
        if($state_id){
            $districts = District::getAllDistricts($state_id);
            if ($districts->isEmpty()) {
                return response()->json(['message' => 'No districts found for this state'], 404);
            }
    
            $options = "<option value=''>Select</option>";
    
            foreach ($districts as $district) {
                $options .= "<option value='{$district->id}'>{$district->district_name}</option>";
            }
    
            return $options;
            // return response()->json($options);
        }
        return response()->json(['message' => 'districts not found'], 404);
    }
}
