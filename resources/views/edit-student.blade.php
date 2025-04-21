
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/alert.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/cropper.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Student</h2>
        <div class="tabs">
            <div class="tab active" data-tab="basics">Basic Information</div>
            <div class="tab" data-tab="education">Academic Details</div>
            <div class="tab" data-tab="documents">Upload Documents</div>
        </div>
        <form action="{{ route('students.update', $student->id,) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="tab-content">
                @method('PUT')
                <div class="tab-pane" id="basics">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="fathersname" class="form-label">Father's Name</label>
                        <input type="text" class="form-control" id="fathersname" name="fathersname" value="{{ $student->basicInformation->fathersname }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="mothersname" class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" id="mothersname" name="mothersname" value="{{ $student->basicInformation->mothersname }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="date_of_birth" value="{{ $student->basicInformation->date_of_birth }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="Male" {{ $student->basicInformation->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $student->basicInformation->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ $student->basicInformation->gender == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone_no" value="{{ $student->phone_no }}" required>
                    </div>
                    <div class="mb-3">
                            <label for="country_id" class="form-label">Country</label>
                            <select id="country_id" name="country_id" class="form-control" required>
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $student->address->country_id == $country->id ? 'selected' : '' }}>
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
                                    <option value="{{ $state->id }}" {{ $student->address->state_id == $state->id ? 'selected' : '' }}>
                                        {{ $state->state_name }} 
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="district_id" class="form-label">District</label>
                            <select id="district_id" name="district_id" class="form-control" required>
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}" {{ $student->address->district_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->district_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <div class="mb-3">
                        <label for="pin" class="form-label">Pin Number</label>
                        <input type="text" class="form-control" id="pin" name="pin_no" value="{{$student->address->pin_no}}" required>
                    </div>
                </div>            
                <div class="tab-pane" id="education">
                    <h4>Academic Details</h4>
                    <div id="academic-details-container">
                        @foreach($student->academicDetails as $index => $academicDetail)
                            <div class="academic-detail-box" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                                <h5>Academic Detail {{ $index + 1 }}</h5>
                                <div class="mb-3">
                            <label for="course_id_{{ $index }}" class="form-label">Course</label>
                            <select id="course_id_{{ $index }}" name="academic_details[{{ $index }}][course_id]" class="form-control course-dropdown" data-index="{{ $index }}" required>
                                <option value="">Select Course</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $academicDetail->course_id == $course->id ? 'selected' : '' }}>
                                        {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="specialization_id_{{ $index }}" class="form-label">Specialization</label>
                            <select id="specialization_id_{{ $index }}" name="academic_details[{{ $index }}][specialization_id]" class="form-control" required>
                                <option value="">Select Specialization</option>
                                @foreach($specializations as $specialization)
                                    <option value="{{ $specialization->id }}" {{ $academicDetail->specialization_id == $specialization->id ? 'selected' : '' }}>
                                        {{ $specialization->specialization_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                                <div class="mb-3">
                                    <label for="class_{{ $index }}" class="form-label">Class</label>
                                    <input type="text" class="form-control" id="class_{{ $index }}" name="academic_details[{{ $index }}][class]" value="{{ $academicDetail->class }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="roll_no_{{ $index }}" class="form-label">Roll Number</label>
                                    <input type="text" class="form-control" id="roll_no_{{ $index }}" name="academic_details[{{ $index }}][roll_no]" value="{{ $academicDetail->roll_no }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="school_id_{{ $index }}" class="form-label">School</label>
                                    <select id="school_id_{{ $index }}" name="academic_details[{{ $index }}][school_id]" class="form-control" required>
                                        <option value="">Select School</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->id }}" {{ $academicDetail->school_id == $school->id ? 'selected' : '' }}>
                                                {{ $school->school_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="button" class="btn btn-danger remove-academic-detail" data-index="{{ $index }}" style="margin-top: 5px;">Remove</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-primary" id="add-academic-detail">Add More Academic Details</button>
                </div>


                <div class="tab-pane" id="documents">
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">

                        <img id="image-thumbnail" style="display: none; width: 150px; margin-top: 10px;" />
                        @if(isset($imageThumbnailName))
                            <img id="old-image-thumbnail" src="{{ asset('storage/students/images/thumbnails/' . $imageThumbnailName) }}" style="max-width: 150px; margin-top: 10px;" />
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="signature" class="form-label">Signature</label>
                        <input type="file" class="form-control" id="signature" name="signature" accept="image/*">

                        <img id="signature-thumbnail" style="display: none; width: 150px; margin-top: 10px;" />
                        @if(isset($signatureThumbnailName))
                            <img id="old-signature-thumbnail" src="{{ asset('storage/students/signatures/thumbnails/' . $signatureThumbnailName) }}" style="max-width: 150px; margin-top: 10px;" />
                        @endif
                    </div>
                </div>
                <div style="display: flex; justify-content: center; gap: 10px; margin-top: 15px;">
                    <button type="submit" class="btn btn-success box-center" style="background-color: green; color: white; padding: 10px 15px; border: none; border-radius: 5px;">
                        Update Student
                    </button>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-secondary" style="background-color: gray; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
                        Back
                    </a>
                </div>
            </div>
        </form>
    </div>

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

    <!-- Crop Signature Modal -->
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
    @if ($errors->any())
        let errorMessages = @json($errors->all());
        Swal.fire({
            title: 'Error',
            text: errorMessages.join("\n"),
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif

    
$(document).ready(function() {
    function loadStates(country_id) {
        $.ajax({
            url: '/states/' + country_id, 
            type: 'GET',
            success: function(response) {
                $('#state_id').html(response); 
                $('#state_id').val("{{ $student->state_id }}").trigger('change'); 
            },
            error: function(xhr, status, error) {
                console.error("Error loading states: " + error);
            }
        });
    }

    function loadDistricts(state_id) {
        $.ajax({
            url: '/districts/' + state_id, 
            type: 'GET',
            success: function(response) {
                $('#district_id').html(response);
                $('#district_id').val("{{ $student->district_id }}").trigger('change');
            },
            error: function(xhr, status, error) {
                console.error("Error loading districts: " + error);
            }
        });
    }

    /************** Load Specializations based on selected course **************/
    function loadSpecializations(course_id) {
        $.ajax({
            url: '/specializations/' + course_id, // Adjust this URL to your route for fetching specializations
            type: 'GET',
            success: function(response) {
                // Replace the specialization dropdown with the new options
                $('#specialization_id').html(response);
                // Set the previously selected specialization if available
                $('#specialization_id').val("{{ $student->specialization_id }}").trigger('change');
            },
            error: function(xhr, status, error) {
                console.error("Error loading specializations: " + error);
            }
        });
    }

    /************** Load State and District based on Country and State **************/
    loadStates("{{ $student->country_id }}");
    loadDistricts("{{ $student->state_id }}");

    // Trigger when the country is changed
    $('#country_id').change(function() {
        var country_id = $(this).val();
        $("#district_id").html('<option value="">Select District</option>');

        /************** Load State based on the selected country **************/
        if (country_id != '') {
            loadStates(country_id);
        }
    });

    // Trigger when the state is changed
    $('#state_id').change(function() {
        var state_id = $(this).val();
        if (state_id != '') {
            loadDistricts(state_id);
        } else {
            $("#district_id").html('<option value="">Select District</option>');
        }
    });

    /************** Load Specializations based on Course Selection **************/
    $('#course_id').change(function() {
        var course_id = $(this).val();
        $("#specialization_id").html('<option value="">Select Specialization</option>'); // Clear the specialization dropdown

        /************** Load Specializations based on the selected course **************/
        if (course_id != '') {
            loadSpecializations(course_id);
        }
    });

    // If a course is already selected (for editing), load its specializations
    if ($("#course_id").val() != '') {
        loadSpecializations("{{ $student->course_id }}");
    }
});

    
    /***********************************Password Validation*************************************** */
    
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle functionality
        const togglePassword = document.getElementById('toggle-password');
        const toggleConfirmPassword = document.getElementById('toggle-password-confirmation');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const passwordError = document.getElementById('password-error');
    
        // Toggle password visibility
        function toggleVisibility(input, button) {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle eye icon
            const icon = button.querySelector('i');
            icon.classList.toggle('fa-eye-slash');
            icon.classList.toggle('fa-eye');
        }
    
        togglePassword.addEventListener('click', function() {
            toggleVisibility(password, this);
        });
    
        toggleConfirmPassword.addEventListener('click', function() {
            toggleVisibility(passwordConfirmation, this);
        });
    
        // Existing validation code
        passwordConfirmation.addEventListener('input', function() {
            if (password.value !== passwordConfirmation.value) {
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }
        });
    
        document.querySelector('form').addEventListener('submit', function(e) {
            if (password.value !== passwordConfirmation.value) {
                e.preventDefault();
                alert("Passwords do not match!");
            }
        });
    });

    

        document.addEventListener("DOMContentLoaded", function() {
        const url = new URL(window.location.href);
        if (url.searchParams.has("error")) {
            setTimeout(() => {
                url.searchParams.delete("error");
                window.history.replaceState({}, document.title, url.pathname + url.search);
            }, 1); 
        }
    });

    //....................................tabs..................................//

    const tabs = document.querySelectorAll('.tab');
        const tabContent = document.querySelectorAll('.tab-pane');
        

        window.addEventListener('load', function() {
            tabs[0].classList.add('active');
            document.getElementById('basics').classList.add('active');

        });

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const targetTab = this.getAttribute('data-tab');
                tabs.forEach(t => t.classList.remove('active'));
                tabContent.forEach(content => content.classList.remove('active'));
                
  
                this.classList.add('active');
                document.getElementById(targetTab).classList.add('active');
            });
        });

        //...........................image&signature........................//

    var cropperImage, cropperSignature;
    var currentInput;

function openCropperImage() {
    currentInput = document.getElementById('image');
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.getElementById('cropper-image');
        img.src = e.target.result;
        if (cropperImage) {
            cropperImage.destroy();
        }
        $('#cropper-modal-image').modal('show');
    };
    reader.readAsDataURL(currentInput.files[0]);
}

function openCropperSignature() {
    currentInput = document.getElementById('signature');
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.getElementById('cropper-signature');
        img.src = e.target.result;
        if (cropperSignature) {
            cropperSignature.destroy();
        }


        $('#cropper-modal-signature').modal('show');
    };
    reader.readAsDataURL(currentInput.files[0]);
}
$('#cropper-modal-image').on('shown.bs.modal', function () {
    var img = document.getElementById('cropper-image');
    cropperImage = new Cropper(img, {
        aspectRatio: 1,
        viewMode: 2,
        autoCropArea: 0.8
    });
});
$('#cropper-modal-signature').on('shown.bs.modal', function () {
    var img = document.getElementById('cropper-signature');
    cropperSignature = new Cropper(img, {
        aspectRatio: 2,
        viewMode: 2,
        autoCropArea: 0.8
    });
});
$('#crop-image').click(function () {
    var canvas = cropperImage.getCroppedCanvas();
    canvas.toBlob(function (blob) {
        var url = URL.createObjectURL(blob);
        var thumbnail = document.getElementById('image-thumbnail');
        thumbnail.src = url;
        thumbnail.style.display = 'block';
        var dataTransfer = new DataTransfer();
        var file = new File([blob], currentInput.files[0].name, { type: currentInput.files[0].type });
        dataTransfer.items.add(file);
        currentInput.files = dataTransfer.files;
    });
    $('#cropper-modal-image').modal('hide');
});
$('#crop-signature').click(function () {
    var canvas = cropperSignature.getCroppedCanvas();
    canvas.toBlob(function (blob) {
        var url = URL.createObjectURL(blob);
        var thumbnail = document.getElementById('signature-thumbnail');
        thumbnail.src = url;
        thumbnail.style.display = 'block';
        var dataTransfer = new DataTransfer();
        var file = new File([blob], currentInput.files[0].name, { type: currentInput.files[0].type });
        dataTransfer.items.add(file);
        currentInput.files = dataTransfer.files;
    });
    $('#cropper-modal-signature').modal('hide');
});

$('#image').change(function () {
    openCropperImage();
});

$('#signature').change(function () {
    openCropperSignature();
});


document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const image = document.getElementById('image-thumbnail');
                image.src = e.target.result;
                image.style.display = 'block';

                // Hide the old image if it exists
                const oldImage = document.getElementById('old-image-thumbnail');
                if (oldImage) {
                    oldImage.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });


    document.getElementById('signature').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const signature = document.getElementById('signature-thumbnail');
                signature.src = e.target.result;
                signature.style.display = 'block';

                // Hide the old signature if it exists
                const oldSignature = document.getElementById('old-signature-thumbnail');
                if (oldSignature) {
                    oldSignature.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    });
});


    $(document).ready(function () {
    let academicDetailIndex = {{ $student->academicDetails->count() }};

    $('#add-academic-detail').click(function () {
        let newAcademicDetail = `
            <div class="academic-detail-box" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                <h5>Academic Detail ${academicDetailIndex + 1}</h5>
                <div class="mb-3">
                    <label for="course_id_${academicDetailIndex}" class="form-label">Course</label>
                    <select id="course_id_${academicDetailIndex}" name="academic_details[${academicDetailIndex}][course_id]" class="form-control" required>
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="specialization_id_${academicDetailIndex}" class="form-label">Specialization</label>
                    <select id="specialization_id_${academicDetailIndex}" name="academic_details[${academicDetailIndex}][specialization_id]" class="form-control" required>
                        <option value="">Select Specialization</option>
                        @foreach($specializations as $specialization)
                            <option value="{{ $specialization->id }}">{{ $specialization->specialization_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="class_${academicDetailIndex}" class="form-label">Class</label>
                    <input type="text" class="form-control" id="class_${academicDetailIndex}" name="academic_details[${academicDetailIndex}][class]" required>
                </div>
                <div class="mb-3">
                    <label for="roll_no_${academicDetailIndex}" class="form-label">Roll Number</label>
                    <input type="text" class="form-control" id="roll_no_${academicDetailIndex}" name="academic_details[${academicDetailIndex}][roll_no]" required>
                </div>
                <div class="mb-3">
                    <label for="school_id_${academicDetailIndex}" class="form-label">School</label>
                    <select id="school_id_${academicDetailIndex}" name="academic_details[${academicDetailIndex}][school_id]" class="form-control" required>
                        <option value="">Select School</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-danger remove-academic-detail" data-index="${academicDetailIndex}" style="margin-top: 5px;">Remove</button>
            </div>
        `;

        $('#academic-details-container').append(newAcademicDetail);
        academicDetailIndex++;
    });

    $(document).on('click', '.remove-academic-detail', function () {
        $(this).closest('.academic-detail-box').remove();
    });
});

</script>
<script src="{{ asset('js/edit-student.js') }}"></script>
<script src="{{ asset('js/alert.js') }}"></script>
<script src="{{ asset('js/cropper.min.js') }}"></script>
<script src="{{ asset('js/crop.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

</body>
</html>
