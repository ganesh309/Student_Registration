<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\School;
use App\Models\Course;
use App\Models\Specialization;
use App\Models\Country;
use App\Models\State;
use App\Models\District;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Mail\StudentRegistrationSuccess;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentUpdateNotification;
use Illuminate\Support\Str;
use App\Models\BasicInformation;
use App\Models\Address;
use App\Models\AcademicDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


//----------------------------------------Display-All-the-Student-Records--------------------------------------------------//
class StudentController extends Controller
{
  public function showStudents(Request $request)
{
    $students = Student::with([
        'basicInformation:id,student_id,fathersname,mothersname,date_of_birth,gender',
        'address:id,student_id,country_id,state_id,district_id,pin_no',
        'academicDetails:id,student_id,school_id',
        'country:id,country_name',
        'state:id,state_name',
        'district:id,district_name'
    ])
    ->whereNotNull('registration_number')
    ->when($request->country_id, function ($query) use ($request) {
        return $query->whereHas('address', function ($q) use ($request) {
            $q->where('country_id', $request->country_id);
        });
    })
    ->when($request->state_id, function ($query) use ($request) {
        return $query->whereHas('address', function ($q) use ($request) {
            $q->where('state_id', $request->state_id);
        });
    })
    ->when($request->district_id, function ($query) use ($request) {
        return $query->whereHas('address', function ($q) use ($request) {
            $q->where('district_id', $request->district_id);
        });
    })
    ->when($request->school_id, function ($query) use ($request) {
        return $query->whereHas('academicDetails', function ($q) use ($request) {
            $q->where('school_id', $request->school_id);
        });
    })
    ->when($request->date_of_birth_from, function ($query) use ($request) {
        return $query->whereHas('basicInformation', function ($q) use ($request) {
            $q->where('date_of_birth', '>=', $request->date_of_birth_from);
        });
    })
    ->when($request->date_of_birth_to, function ($query) use ($request) {
        return $query->whereHas('basicInformation', function ($q) use ($request) {
            $q->where('date_of_birth', '<=', $request->date_of_birth_to);
        });
    })
    ->when($request->gender, function ($query) use ($request) {
        return $query->whereHas('basicInformation', function ($q) use ($request) {
            $q->where('gender', $request->gender);
        });
    })
    ->when($request->search, function ($query) use ($request) {
        $searchTerm = '%' . $request->search . '%';
    
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'like', $searchTerm)
              ->orWhere('registration_number', 'like', $searchTerm)
              ->orWhere('email', 'like', $searchTerm)
              ->orWhere('phone_no', 'like', $searchTerm)
    
              // Basic Information
              ->orWhereHas('basicInformation', function ($q2) use ($searchTerm) {
                  $q2->where('fathersname', 'like', $searchTerm)
                     ->orWhere('mothersname', 'like', $searchTerm)
                     ->orWhere('date_of_birth', 'like', $searchTerm)
                     ->orWhere('gender', 'like', $searchTerm);
              })
    
              // Address Details
              ->orWhereHas('address', function ($q3) use ($searchTerm) {
                  $q3->where('pin_no', 'like', $searchTerm);
              })
    
              // School/Academic Details
              ->orWhereHas('academicDetails', function ($q4) use ($searchTerm) {
                  $q4->where('school_id', 'like', $searchTerm);
              })
    
              // Country Name
              ->orWhereHas('address.country', function ($q5) use ($searchTerm) {
                  $q5->where('country_name', 'like', $searchTerm);
              })
    
              // State Name
              ->orWhereHas('address.state', function ($q6) use ($searchTerm) {
                  $q6->where('state_name', 'like', $searchTerm);
              })
    
              // District Name
              ->orWhereHas('address.district', function ($q7) use ($searchTerm) {
                  $q7->where('district_name', 'like', $searchTerm);
              });
        });
    })
    
    
    ->orderByDesc('created_at')
    ->paginate($request->input('per_page', 5))
    ->appends($request->except('page'));

    $countries = Country::all();
    $states = State::all();
    $districts = District::all();
    $schools = School::all();

    return view('students', compact('students', 'countries', 'states', 'districts', 'schools'));
}


//----------------------------------------------------------------------------------------------------------//




public function edit($id)
{
    $student = Student::with([
        'address',
        'basicInformation',
        'academicDetails',
    ])->findOrFail($id);

    $schools = School::all();
    $courses = Course::all();
    $specializations = Specialization::all();
    $countries = Country::all();
    $states = State::where('country_id', $student->address->country_id)->get();
    $districts = District::where('state_id', $student->address->state_id)->get();

    // Thumbnail generation
    $studentName = strtolower(str_replace(' ', '_', $student->name));
    $regNo = $student->registration_number ?? 'N/A'; // Use first roll_no if available

    $imageThumbnailName = "{$studentName}_{$regNo}_thumbnail." . pathinfo($student->image ?? '', PATHINFO_EXTENSION);
    $signatureThumbnailName = "{$studentName}_{$regNo}_thumbnail." . pathinfo($student->signature ?? '', PATHINFO_EXTENSION);

    return view('edit-student', compact(
        'student',
        'schools',
        'courses',
        'specializations',
        'countries',
        'states',
        'districts',
        'imageThumbnailName',
        'signatureThumbnailName'
    ));
}



public function update(Request $request, $id)
{
    try {
        $student = Student::findOrFail($id);
        $basicInformation = $student->basicInformation;
        $address = $student->address;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'fathersname' => 'required|string|max:255',
            'mothersname' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone_no' => 'required|string|max:15',
            'country_id' => 'required|integer',
            'state_id' => 'required|integer',
            'district_id' => 'required|integer',
            'pin_no' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'academic_details' => 'nullable|array',
            'academic_details.*.school_id' => 'required_with:academic_details|integer',
            'academic_details.*.course_id' => 'required_with:academic_details|integer',
            'academic_details.*.specialization_id' => 'required_with:academic_details|integer',
            'academic_details.*.class' => 'required_with:academic_details|string|max:50',
            'academic_details.*.roll_no' => 'required_with:academic_details|string|max:50',
            'academic_details.*.id' => 'nullable|integer|exists:academic_details,id',
        ]);

        $studentName = strtolower(str_replace(' ', '_', $student->name));
        $regNo = $student->registration_number;

        // Handling Image Upload
        if ($request->hasFile('image')) {
            $imageThumbnailName = "{$studentName}_{$regNo}_thumbnail.{$request->file('image')->getClientOriginalExtension()}";
            if ($student->image) {
                Storage::delete('public/students/images/' . $student->image);
                Storage::delete('public/students/images/thumbnails/' . $imageThumbnailName);
            }
            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = "{$studentName}_{$regNo}.{$imageExtension}";
            $imagePath = $image->storeAs('students/images', $imageName, 'public');
            $validated['image'] = $imageName;
            $this->generateThumbnail($image, $imageThumbnailName, 'students/images/thumbnails');
        }

        // Handling Signature Upload
        if ($request->hasFile('signature')) {
            $signatureThumbnailName = "{$studentName}_{$regNo}_thumbnail.{$request->file('signature')->getClientOriginalExtension()}";
            if ($student->signature) {
                Storage::delete('public/students/signatures/' . $student->signature);
                Storage::delete('public/students/signatures/thumbnails/' . $signatureThumbnailName);
            }
            $signature = $request->file('signature');
            $signatureExtension = $signature->getClientOriginalExtension();
            $signatureName = "{$studentName}_{$regNo}.{$signatureExtension}";
            $signaturePath = $signature->storeAs('students/signatures', $signatureName, 'public');
            $validated['signature'] = $signatureName;
            $this->generateThumbnail($signature, $signatureThumbnailName, 'students/signatures/thumbnails');
        }

        // Update Student Info
        $student->update($validated);

        // Update Basic Information
        $basicInformation->update([
            'fathersname' => $validated['fathersname'],
            'mothersname' => $validated['mothersname'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
        ]);

        // Update Address
        $address->update([
            'country_id' => $validated['country_id'],
            'state_id' => $validated['state_id'],
            'district_id' => $validated['district_id'],
            'pin_no' => $validated['pin_no'],
        ]);

        // Handling Academic Details
        $existingAcademicIds = $student->academicDetails->pluck('id')->toArray();
        $submittedIds = collect($validated['academic_details'])->pluck('id')->filter()->toArray();

        // Update or Create Academic Details
        foreach ($validated['academic_details'] as $academicDetailData) {
            if (isset($academicDetailData['id'])) {
                // Update existing academic detail
                AcademicDetail::where('id', $academicDetailData['id'])
                    ->where('student_id', $student->id)
                    ->update([
                        'school_id' => $academicDetailData['school_id'],
                        'course_id' => $academicDetailData['course_id'],
                        'specialization_id' => $academicDetailData['specialization_id'],
                        'class' => $academicDetailData['class'],
                        'roll_no' => $academicDetailData['roll_no'],
                    ]);
            } else {
                // Create new academic detail
                AcademicDetail::create([
                    'student_id' => $student->id,
                    'school_id' => $academicDetailData['school_id'],
                    'course_id' => $academicDetailData['course_id'],
                    'specialization_id' => $academicDetailData['specialization_id'],
                    'class' => $academicDetailData['class'],
                    'roll_no' => $academicDetailData['roll_no'],
                ]);
            }
        }
        
        

        // Delete Academic Details that are not submitted in the request
        $idsToDelete = array_diff($existingAcademicIds, $submittedIds);
        AcademicDetail::whereIn('id', $idsToDelete)->delete();

        // Send Email Notification
        Mail::to($student->email)->send(new StudentUpdateNotification($student));

        return redirect()->route('student.dashboard')->with('success', 'Student updated successfully!');
    } catch (ValidationException $e) {
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        \Log::error("Error updating student: ", ['error_message' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Error updating student: ' . $e->getMessage())->withInput();
    }
}




private function generateThumbnail($file, $thumbnailName, $destinationPath)
{
    $imageResource = imagecreatefromstring(file_get_contents($file));
    $maxSize = 150;
    list($width, $height) = getimagesize($file);
    $newWidth = $width > $height ? $maxSize : ($width / $height) * $maxSize;
    $newHeight = $height > $width ? $maxSize : ($height / $width) * $maxSize;
 
    $thumbnail = imagescale($imageResource, $newWidth, $newHeight);
    $thumbnailPath = public_path("storage/{$destinationPath}/{$thumbnailName}");
    imagejpeg($thumbnail, $thumbnailPath, 80); 
    imagedestroy($imageResource); 
}



public function destroy($id)
{
    $student = Student::findOrFail($id);

    if ($student->image) {
        $imagePath = 'public/students/images/' . $student->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $studentName = strtolower(str_replace(' ', '_', $student->name));
        $reglNo = $student->registration_number;
        $imageExtension = pathinfo($student->image, PATHINFO_EXTENSION);
        $imageThumbnailName = "{$studentName}_{$reglNo}_thumbnail.{$imageExtension}"; 
        $imageThumbnailPath = 'public/students/images/thumbnails/' . $imageThumbnailName;
        
        if (Storage::exists($imageThumbnailPath)) {
            Storage::delete($imageThumbnailPath);
        }
    }


    if ($student->signature) {
        $signaturePath = 'public/students/signatures/' . $student->signature;
        if (Storage::exists($signaturePath)) {
            Storage::delete($signaturePath);
        }
        $studentName = strtolower(str_replace(' ', '_', $student->name));
        $reglNo = $student->registration_number;
        $signatureExtension = pathinfo($student->signature, PATHINFO_EXTENSION); 
        $signatureThumbnailName = "{$studentName}_{$reglNo}_thumbnail.{$signatureExtension}";
        $signatureThumbnailPath = 'public/students/signatures/thumbnails/' . $signatureThumbnailName;

        if (Storage::exists($signatureThumbnailPath)) {
            Storage::delete($signatureThumbnailPath);
        }
    }

    $student->delete();
    return redirect()->route('students.index', ['success_message' => urlencode('Student deleted successfully!')]);
}


//********************************//

public function index()
{

    $maleCount = Student::whereHas('basicInformation', function ($query) {
        $query->where('gender', 'male');
    })->count();

    $femaleCount = Student::whereHas('basicInformation', function ($query) {
        $query->where('gender', 'female');
    })->count();

    $indianCount = Student::whereHas('address', function ($query) {
        $query->where('country_id', 1);
    })->count();

    $nonIndianCount = Student::whereHas('address', function ($query) {
        $query->where('country_id', 2);
    })->count();

    return view('welcome', compact('maleCount', 'femaleCount', 'indianCount', 'nonIndianCount'));
}

//     public function edit($id)
// {
    // $student = Student::with([
    //     'address',
    //     'basicInformation',
    //     'academicDetails',
    // ])->findOrFail($id);

    // $schools = School::all();
    // $courses = Course::all();
    // $specializations = Specialization::all();
    // $countries = Country::all();
    // $states = State::where('country_id', $student->address->country_id)->get();
    // $districts = District::where('state_id', $student->address->state_id)->get();

//     // Thumbnail generation
//     $studentName = strtolower(str_replace(' ', '_', $student->name));
//     $regNo = $student->registration_number ?? 'N/A'; // Use first roll_no if available

//     $imageThumbnailName = "{$studentName}_{$regNo}_thumbnail." . pathinfo($student->image ?? '', PATHINFO_EXTENSION);
//     $signatureThumbnailName = "{$studentName}_{$regNo}_thumbnail." . pathinfo($student->signature ?? '', PATHINFO_EXTENSION);

    // return view('edit-student', compact(
    //     'student',
    //     'schools',
    //     'courses',
    //     'specializations',
    //     'countries',
    //     'states',
    //     'districts',
    //     'imageThumbnailName',
    //     'signatureThumbnailName'
    // ));
// }
public function show_register()
{
    $studentId = session('student_id');
    $student = $studentId ? Student::with(['address', 'basicInformation', 'academicDetails'])->find($studentId) : null;
    $countries = Country::all();
    // Always define these variables, regardless of $student
    $schools = School::all();
    $courses = Course::all();
    $specializations = Specialization::all();
    

    // Define states and districts based on $student, with fallback to empty collections
    $states = $student && $student->address ? State::where('country_id', $student->address->country_id ?? '')->get() : collect();
    $districts = $student && $student->address ? District::where('state_id', $student->address->state_id ?? '')->get() : collect();

    return view('student-form', compact(
        'student',
        'schools',
        'courses',
        'specializations',
        'countries',
        'states',
        'districts'
    ));
}

    
    

//.........................................................Save-Student-Registered-Data-In-DataBase....................................................//
    

public function register(Request $request)
    {
        try {
            $studentId = session('student_id');
            $student = Student::find($studentId);

            if (!$student) {
                return redirect()->route('register.form')->with('error', 'Session expired! Please start again.');
            }

            $validated = $request->validate([
                'fathersname' => 'required|string|max:255',
                'mothersname' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:Male,Female,Other',
                'phone_no' => 'required|string|max:15',
                'district_id' => 'required|integer',
                'state_id' => 'required|integer',
                'country_id' => 'required|integer',
                'pin_no' => 'required|string|max:10',
            ]);

            $basicInformation = BasicInformation::updateOrCreate(
                ['student_id' => $student->id],
                [
                    'fathersname' => $validated['fathersname'],
                    'mothersname' => $validated['mothersname'],
                    'date_of_birth' => $validated['date_of_birth'],
                    'gender' => $validated['gender'],
                ]
            );

            $address = Address::updateOrCreate(
                ['student_id' => $student->id],
                [
                    'country_id' => $validated['country_id'],
                    'state_id' => $validated['state_id'],
                    'district_id' => $validated['district_id'],
                    'pin_no' => $validated['pin_no'],
                ]
            );

            $student->update([
                'phone_no' => $validated['phone_no'],
                'address_id' => $address->id,
                'basic_information_id' => $basicInformation->id,
            ]);

            Session::put('student_id', $student->id);
            return redirect()->route('register.education.form')->with('activeTab', 'education')->with('success', 'Basic Information saved successfully');

        } catch (\Exception $e) {
            Log::error("Error updating student: ", ['error_message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error updating student: ' . $e->getMessage())->withInput();
        }
    }

    public function showEducationForm()
{
    $studentId = session('student_id');
    $student = $studentId ? Student::with(['address', 'basicInformation', 'academicDetails'])->find($studentId) : null;

    $schools = School::all();
    $courses = Course::all();
    $specializations = Specialization::all();
    $countries = Country::all();
    $states = $student && $student->address ? State::where('country_id', $student->address->country_id ?? '')->get() : collect();
    $districts = $student && $student->address ? District::where('state_id', $student->address->state_id ?? '')->get() : collect();

    return view('student-form', compact(
        'student',
        'schools',
        'courses',
        'specializations',
        'countries',
        'states',
        'districts'
    ))->with('activeTab', 'education');
}

    public function registerEducation(Request $request)
    {
        try {
            $studentId = Session::get('student_id');
            Log::info('Retrieved student_id from session: ' . $studentId);

            if (!$studentId) {
                Log::warning('No student_id found in session');
                return redirect()->route('register.form')->with('error', 'Session expired! Please start again.');
            }

            $student = Student::find($studentId);
            if (!$student) {
                Log::warning('Student not found in database for ID: ' . $studentId);
                return redirect()->route('register.form')->with('error', 'Student not found for ID: ' . $studentId . '. Please start again.');
            }

            Log::info('Student found: ', $student->toArray());

            Log::info('Incoming Education Request Data:', $request->all());
            $validated = $request->validate([
                'education_details' => 'required|array|min:1',
                'education_details.*.course_id' => 'required|integer|exists:course,id',
                'education_details.*.specialization_id' => 'required|integer|exists:specialization,id',
                'education_details.*.class' => 'required|string|max:50',
                'education_details.*.roll_no' => 'required|string|max:50',
                'education_details.*.school_id' => 'required|integer|exists:school,id',
            ]);

            Log::info('Validated Education Data:', $validated);
            $deleted = AcademicDetail::where('student_id', $student->id)->delete();
            Log::info('Deleted existing academic details count: ' . $deleted);
            foreach ($validated['education_details'] as $index => $education) {
                $academicDetail = AcademicDetail::create([
                    'student_id' => $student->id,
                    'course_id' => $education['course_id'],
                    'specialization_id' => $education['specialization_id'],
                    'school_id' => $education['school_id'],
                    'class' => $education['class'],
                    'roll_no' => $education['roll_no'],
                ]);
                Log::info("Inserted Academic Detail #{$index}: ", $academicDetail->toArray());
            }

            Session::put('student_id', $student->id);
            return redirect()->route('register.document.form')
                ->with('activeTab', 'document')
                ->with('success', 'Education details saved successfully');

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error saving education details: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Error saving education details: ' . $e->getMessage())->withInput();
        }
    }


    public function showDocumentForm()
{
    $studentId = session('student_id');
    $student = $studentId ? Student::with(['address', 'basicInformation', 'academicDetails'])->find($studentId) : null;

    $schools = School::all();
    $courses = Course::all();
    $specializations = Specialization::all();
    $countries = Country::all();
    $states = $student && $student->address ? State::where('country_id', $student->address->country_id ?? '')->get() : collect();
    $districts = $student && $student->address ? District::where('state_id', $student->address->state_id ?? '')->get() : collect();

    return view('student-form', compact(
        'student',
        'schools',
        'courses',
        'specializations',
        'countries',
        'states',
        'districts'
    ))->with('activeTab', 'document');
}
  
    public function registerDocument(Request $request)
    {
        try {
            $studentId = session('student_id');
            $student = Student::find($studentId);

            if (!$student) {
                return redirect()->route('register.form')->with('error', 'Session expired! Please start again.');
            }

            if (!$student->registration_number) {
                do {
                    $registrationNumber = 'STU' . date('Ymd') . strtoupper(substr(uniqid(), -4));
                } while (Student::where('registration_number', $registrationNumber)->exists());

                $student->registration_number = $registrationNumber;
            }
            $student->update([
                'registration_number' => $student->registration_number,
            ]);

            $validated = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'signature' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);                 

            $studentName = strtolower(str_replace(' ', '_', $student->name));
            $regNo = $student->registration_number ?? 'unknown';

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageExtension = $image->getClientOriginalExtension();
                $imageName = "{$studentName}_{$regNo}.{$imageExtension}";
                $image->storeAs('students/images', $imageName, 'public');

                $thumbnailName = "{$studentName}_{$regNo}_thumbnail.{$imageExtension}";
                $thumbnailPath = storage_path("app/public/students/images/thumbnails/{$thumbnailName}");
                $this->createThumbnail($image, $thumbnailPath);

                $student->image = $imageName;
            }

            if ($request->hasFile('signature')) {
                $signature = $request->file('signature');
                $signatureExtension = $signature->getClientOriginalExtension();
                $signatureName = "{$studentName}_{$regNo}.{$signatureExtension}";
                $signature->storeAs('students/signatures', $signatureName, 'public');

                $signatureThumbName = "{$studentName}_{$regNo}_thumbnail.{$signatureExtension}";
                $signatureThumbPath = storage_path("app/public/students/signatures/thumbnails/{$signatureThumbName}");
                $this->createThumbnail($signature, $signatureThumbPath);

                $student->signature = $signatureName;
            }


            $student->update([
                'image' => $student->image,
                'signature' => $student->signature,
                // 'registration_number' => $student->registration_number,
            ]);

            Mail::to($student->email)->send(new StudentRegistrationSuccess($student));

            Session::put('student_id', $student->id);
            return redirect()->route('student.dashboard')->with('success', 'Registration Done successfully!');

        } catch (\Exception $e) {
            Log::error("Error updating student: ", ['error_message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error updating student: ' . $e->getMessage())->withInput();
        }
    }
    
//........................................................................................................................................//

//......................................................Create-Thumbnails.................................................................//
   
private function createThumbnail($file, $path)
    {
        Image::make($file)
            ->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save($path);
    }
//........................................................................................................................................//

//..................................................Print.................................................................................//
    
    
public function print($id)
{
    // Fetch student details
    $student = Student::with([
        'address',
        'basicInformation'
    ])->findOrFail($id);

    // Fetch academic details directly using student_id
    $academicDetail = AcademicDetail::where('student_id', $id)->first();

    // Fetch additional data
    $schools = School::all();
    $courses = Course::all();
    $specializations = collect();

    if ($academicDetail) {
        $specializations = Specialization::where('course_id', $academicDetail->course_id)->get();
    }

    $countries = Country::all();
    $states = State::where('country_id', $student->address->country_id)->get();
    $districts = District::where('state_id', $student->address->state_id)->get();

    return view('print', compact(
        'student',
        'academicDetail',
        'schools',
        'courses',
        'specializations',
        'countries',
        'states',
        'districts'
    ));
}

//........................................................................................................................................//


}
