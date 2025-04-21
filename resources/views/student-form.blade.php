<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cropper.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Arial, sans-serif;
            background-image: url('{{ asset('css/img.jpg') }}');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            animation: fadeInBody 1s ease-in;
        }

        @keyframes fadeInBody {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .container {
            max-width: 950px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(5px);
            animation: slideInContainer 0.6s ease-out;
        }

        @keyframes slideInContainer {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #1a2e45;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
        }

        h6 {
            color: #95a5a6;
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
            font-style: italic;
        }

        .tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 35px;
            background: #f4f7fa;
            border-radius: 10px;
            padding: 5px;
        }

        .tab {
            flex: 1;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            color: #7f8c8d;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 8px;
        }

        .tab:hover {
            background: #e9ecef;
            color: #007bff;
            transform: scale(1.03);
        }

        .tab.active {
            background: #007bff;
            color: #fff;
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.3);
        }

        .tab-content .tab-pane {
            display: none;
            opacity: 0;
        }

        .tab-content .tab-pane.active {
            display: block;
            animation: fadeInTab 0.5s ease-out forwards;
        }

        @keyframes fadeInTab {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-label {
            color: #34495e;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 15px;
            transition: color 0.3s ease;
        }

        .form-control, .form-select {
            border: 2px solid #e0e6e8;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fdfdfd;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
            background: #f9fbfc;
            outline: none;
        }

        .form-control:hover, .form-select:hover {
            border-color: #b0c4de;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            padding: 12px 25px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003d82);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(220, 53, 69, 0.2);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.3);
        }

        .form-row {
            display: flex;
            gap: 25px;
            margin-bottom: 20px;
        }

        .form-row .mb-3 {
            flex: 1;
        }

        .education-details {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            background: #f8fafc;
            padding: 25px;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            animation: slideInEducation 0.4s ease-out;
        }

        @keyframes slideInEducation {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .education-details h4 {
            grid-column: span 5;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-custom-sm {
            padding: 10px 20px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 15px;
            }

            .education-details {
                grid-template-columns: 1fr;
            }

            .education-details h4 {
                grid-column: span 1;
            }

            .button-container {
                flex-direction: column;
                gap: 10px;
            }

            .btn-custom-sm {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Student Registration Form</h2>
        <h6>Please Enter All the Details Very Carefully</h6>

        <!-- Tab Navigation -->
        <div class="tabs">
            <div class="tab {{ session('activeTab', 'basics') == 'basics' ? 'active' : '' }}" data-tab="basics">Basic Information</div>
            <div class="tab {{ session('activeTab') == 'education' ? 'active' : '' }}" data-tab="education">Education Information</div>
            <div class="tab {{ session('activeTab') == 'document' ? 'active' : '' }}" data-tab="document">Upload Documents</div>
        </div>

        <!-- Basic Information Form -->
        <form name="activeTab" id="activeTabInput" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="activeTab" value="education">
            <div class="tab-content">
                <div class="tab-pane {{ session('activeTab', 'basics') == 'basics' ? 'active' : '' }}" id="basics">
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $student->name ?? '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $student->email ?? '' }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="fathersname" class="form-label">Father's Name</label>
                            <input type="text" class="form-control" id="fathersname" name="fathersname" placeholder="Enter Father's Name" value="{{ old('fathersname', $student->basicInformation->fathersname ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="mothersname" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control" id="mothersname" name="mothersname" placeholder="Enter Mother's Name" value="{{ old('mothersname', $student->basicInformation->mothersname ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $student->basicInformation->date_of_birth ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="" disabled>Select Gender</option>
                                <option value="Male" {{ ($student->basicInformation->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ ($student->basicInformation->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ ($student->basicInformation->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone_no" placeholder="Enter Phone No" value="{{ old('phone_no', $student->phone_no ?? '') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="pin" class="form-label">Pin Number</label>
                            <input type="text" class="form-control" id="pin" name="pin_no" placeholder="Enter Pin No" value="{{ old('pin_no', $student->address->pin_no ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="country_id" class="form-label">Country</label>
                            <select id="country_id" name="country_id" class="form-control" required>
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ ($student->address->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                        {{ $country->country_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="state_id" class="form-label">State</label>
                            <select id="state_id" name="state_id" class="form-control" required>
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ ($student->address->state_id ?? '') == $state->id ? 'selected' : '' }}>
                                        {{ $state->state_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="district_id" class="form-label">District</label>
                        <select id="district_id" name="district_id" class="form-control" required>
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}" {{ ($student->address->district_id ?? '') == $district->id ? 'selected' : '' }}>
                                    {{ $district->district_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-custom-sm" id="next-basics">Save & Next</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Education Information Form -->
        <form id="registrationFormEducation" action="{{ route('register.education') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="activeTab" value="document">
            <div class="tab-content">
                <div class="tab-pane {{ session('activeTab') == 'education' ? 'active' : '' }}" id="education">
                    <div id="education-details-container">
                        @if(isset($student) && $student->academicDetails->isNotEmpty())
                            @foreach($student->academicDetails as $index => $academicDetail)
                                <div class="education-details">
                                    <h4>Education Details {{ $index + 1 }}</h4>
                                    <div class="mb-3">
                                        <label for="course" class="form-label">Course</label>
                                        <select name="education_details[{{ $index }}][course_id]" class="form-control course-dropdown" required>
                                            <option value="">Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ $academicDetail->course_id == $course->id ? 'selected' : '' }}>
                                                    {{ $course->course_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="specialization" class="form-label">Specialization</label>
                                        <select name="education_details[{{ $index }}][specialization_id]" class="form-control specialization-dropdown" required>
                                            <option value="">Select Specialization</option>
                                            @foreach($specializations as $specialization)
                                                <option value="{{ $specialization->id }}" {{ $academicDetail->specialization_id == $specialization->id ? 'selected' : '' }}>
                                                    {{ $specialization->specialization_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="class" class="form-label">Class</label>
                                        <input type="text" class="form-control" name="education_details[{{ $index }}][class]" placeholder="e.g., Completed" value="{{ old("education_details.{$index}.class", $academicDetail->class ?? '') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rollno" class="form-label">Roll No</label>
                                        <input type="text" class="form-control" name="education_details[{{ $index }}][roll_no]" placeholder="Enter Roll No" value="{{ old("education_details.{$index}.roll_no", $academicDetail->roll_no ?? '') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="school_id" class="form-label">School Name</label>
                                        <select name="education_details[{{ $index }}][school_id]" class="form-control school-dropdown" required>
                                            <option value="">Select School</option>
                                            @foreach($schools as $school)
                                                <option value="{{ $school->id }}" {{ $academicDetail->school_id == $school->id ? 'selected' : '' }}>
                                                    {{ $school->school_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($index > 0)
                                        <button type="button" class="btn btn-danger btn-remove-education">Remove</button>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="education-details">
                                <h4>Education Details 1</h4>
                                <div class="mb-3">
                                    <label for="course" class="form-label">Course</label>
                                    <select name="education_details[0][course_id]" class="form-control course-dropdown" required>
                                        <option value="">Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="specialization" class="form-label">Specialization</label>
                                    <select name="education_details[0][specialization_id]" class="form-control specialization-dropdown" required>
                                        <option value="">Select Specialization</option>
                                        @foreach($specializations as $specialization)
                                            <option value="{{ $specialization->id }}">{{ $specialization->specialization_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <input type="text" class="form-control" name="education_details[0][class]" placeholder="e.g., Completed" value="{{ old('education_details.0.class') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="rollno" class="form-label">Roll No</label>
                                    <input type="text" class="form-control" name="education_details[0][roll_no]" placeholder="Enter Roll No" value="{{ old('education_details.0.roll_no') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="school_id" class="form-label">School Name</label>
                                    <select name="education_details[0][school_id]" class="form-control school-dropdown" required>
                                        <option value="">Select School</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary btn-add-education">Add New Education</button>
                    <div class="button-container">
                        <button type="button" class="btn btn-primary btn-custom-sm mt-3 btn-prev" id="prev-education">Back</button>
                        <button type="submit" class="btn btn-primary btn-custom-sm" id="next-education">Save & Next</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Upload Documents Form -->
        <form id="registrationFormDocument" action="{{ route('register.document') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tab-content">
                <div class="tab-pane {{ session('activeTab') == 'document' ? 'active' : '' }}" id="document">
                    <div class="form-row">
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            <div id="image-preview" class="mt-2">
                                <img id="image-thumbnail" src="" alt="Image Thumbnail" style="max-width: 200px; display: none;" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="signature" class="form-label">Signature</label>
                            <input type="file" class="form-control" id="signature" name="signature" accept="image/*" required>
                            <div id="signature-preview" class="mt-2">
                                <img id="signature-thumbnail" src="" alt="Signature Thumbnail" style="max-width: 200px; display: none;" />
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="button" class="btn btn-primary btn-custom-sm mt-3 btn-prev" id="prev-documents">Back</button>
                        <button type="submit" class="btn btn-primary btn-custom-sm" id="btn-register">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Cropper Modals -->
    <div id="cropper-modal-image" class="modal fade" tabindex="-1" aria-labelledby="cropper-modal-image-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropper-modal-image-label">Crop Profile Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="cropper-container-image">
                        <img id="cropper-image" src="" alt="Image to Crop" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="crop-image">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <div id="cropper-modal-signature" class="modal fade" tabindex="-1" aria-labelledby="cropper-modal-signature-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropper-modal-signature-label">Crop Signature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="cropper-container-signature">
                        <img id="cropper-signature" src="" alt="Signature to Crop" style="max-width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="crop-signature">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let activeTab = "{{ session('activeTab', 'basics') }}";

        function showTab(tabId) {
            document.querySelectorAll(".tab-pane").forEach((pane) => {
                pane.classList.remove("active");
            });
            document.getElementById(tabId).classList.add("active");

            document.querySelectorAll(".tab").forEach((tab) => {
                tab.classList.remove("active");
            });
            document.querySelector(`.tab[data-tab="${tabId}"]`).classList.add("active");
        }

        showTab(activeTab);

        document.querySelectorAll(".tab").forEach(tab => {
            tab.addEventListener("click", function () {
                const tabId = this.getAttribute("data-tab");
                let allValid = true;
                document.querySelectorAll('input[required], select[required], textarea[required]').forEach(field => {
                    if (!field.value.trim()) {
                        allValid = false;
                        field.classList.add("is-invalid");
                    } else {
                        field.classList.remove("is-invalid");
                    }
                });

                if (allValid) {
                    showTab(tabId);
                    sessionStorage.setItem('activeTab', tabId);
                } else {
                    alert("Please fill all mandatory fields before moving to the next tab.");
                }
            });
        });

        document.querySelectorAll(".btn-prev").forEach(button => {
            button.addEventListener("click", function () {
                let prevTab;
                if (this.id === "prev-education") prevTab = "basics";
                else if (this.id === "prev-documents") prevTab = "education";
                showTab(prevTab);
            });
        });
    });

    $(document).ready(function() {
        function loadStates(country_id) {
            if (!country_id) return;
            $.ajax({
                url: '/states/' + country_id,
                type: 'GET',
                success: function(response) {
                    $('#state_id').html(response);
                    $('#state_id').val("{{ $student->address->state_id ?? '' }}").trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error("Error loading states: " + error);
                }
            });
        }

        function loadDistricts(state_id) {
            if (!state_id) return;
            $.ajax({
                url: '/districts/' + state_id,
                type: 'GET',
                success: function(response) {
                    $('#district_id').html(response);
                    $('#district_id').val("{{ $student->address->district_id ?? '' }}").trigger('change');
                },
                error: function(xhr, status, error) {
                    console.error("Error loading districts: " + error);
                }
            });
        }

        function loadSpecializations(dropdown, course_id) {
            if (!course_id) return;
            $.ajax({
                url: '/specializations/' + course_id,
                type: 'GET',
                success: function(response) {
                    const specializationDropdown = dropdown.closest('.education-details').find('.specialization-dropdown');
                    specializationDropdown.html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error loading specializations: " + error);
                }
            });
        }

        @if(isset($student))
            loadStates("{{ $student->address->country_id ?? '' }}");
            loadDistricts("{{ $student->address->state_id ?? '' }}");
        @endif

        $('#country_id').change(function() {
            const country_id = $(this).val();
            $("#district_id").html('<option value="">Select District</option>');
            if (country_id) loadStates(country_id);
        });

        $('#state_id').change(function() {
            const state_id = $(this).val();
            if (state_id) loadDistricts(state_id);
            else $("#district_id").html('<option value="">Select District</option>');
        });

        $(document).on('change', '.course-dropdown', function() {
            const course_id = $(this).val();
            if (course_id) loadSpecializations($(this), course_id);
        });

        $('.btn-add-education').click(function() {
            const newIndex = $('#education-details-container .education-details').length;
            const newEducation = `
                <div class="education-details">
                    <h4>Education Details ${newIndex + 1}</h4>
                    <div class="mb-3">
                        <label for="course" class="form-label">Course</label>
                        <select name="education_details[${newIndex}][course_id]" class="form-control course-dropdown" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Specialization</label>
                        <select name="education_details[${newIndex}][specialization_id]" class="form-control specialization-dropdown" required>
                            <option value="">Select Specialization</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="class" class="form-label">Class</label>
                        <input type="text" class="form-control" name="education_details[${newIndex}][class]" placeholder="e.g., Completed" required>
                    </div>
                    <div class="mb-3">
                        <label for="rollno" class="form-label">Roll No</label>
                        <input type="text" class="form-control" name="education_details[${newIndex}][roll_no]" placeholder="Enter Roll No" required>
                    </div>
                    <div class="mb-3">
                        <label for="school_id" class="form-label">School Name</label>
                        <select name="education_details[${newIndex}][school_id]" class="form-control school-dropdown" required>
                            <option value="">Select School</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger btn-remove-education">Remove</button>
                </div>
            `;
            const $newElement = $(newEducation);
            $('#education-details-container').append($newElement);
            $newElement.hide().slideDown(400);
        });

        $(document).on('click', '.btn-remove-education', function() {
            const $element = $(this).closest('.education-details');
            $element.slideUp(400, function() {
                $(this).remove();
            });
        });
    });
    </script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/cropper.min.js') }}"></script>
    <script src="{{ asset('js/thumbnail.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/crop.js') }}"></script>
</body>
</html>