@include('layouts.navbar')
<div class="containers" style="padding-top: 60px;">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Students List</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/students.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="mx-auto" style="max-width: 600px;">
        </div>
        <h2 class="mb-4 text-center" style="border-bottom: 3px double #2c3e50;">Student List </h2>

        <div class="container">
            <form method="GET" action="{{ url()->current() }}" class="mb-3">
                <div class="d-flex justify-content-between align-items-end">
                    <div>
                        <label for="per_page" class="form-label">Records per page:</label>
                        <select name="per_page" id="per_page" class="form-select form-select-sm">
                            @foreach([5, 10, 25, 50, 100] as $limit)
                                <option value="{{ $limit }}" {{ request('per_page') == $limit ? 'selected' : '' }}>
                                    {{ $limit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="search" class="form-label">Search Student by Any Details</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search.....">
                    </div>
                </div>
                @foreach(request()->except(['per_page', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
            </form>
        
            <div class="accordion" id="advancedFilterAccordion">
                <div class="accordion-item" >
                    <h2 class="accordion-header" id="headingFilter">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                            Advance Filter
                        </button>
                    </h2>
                    
                    <div id="collapseFilter" class="accordion-collapse collapse" aria-labelledby="headingFilter">
                        <div class="accordion-body">
                            <form method="GET" action="{{ route('students.index') }}" id="filter-form">
                                <div class="row mb-3 mx-0" style="background-color: #b0c4d4">
                                    <div class="col-md-3">
                                        <select name="country_id" id="country" class="form-control">
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}" {{ request('country_id') == $country->id ? 'selected' : '' }}>
                                                    {{ $country->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select name="state_id" id="state" class="form-control" disabled>
                                            <option value="">Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" {{ request("state_id") == $state->id ? 'selected' : '' }}>
                                                    {{ $state->state_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select name="district_id" id="district" class="form-control" disabled>
                                            <option value="">Select District</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" {{ request('district_id') == $district->id ? 'selected' : '' }}>
                                                    {{ $district->district_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select name="school_id" id="school" class="form-control">
                                            <option value="">Select University</option>
                                            @foreach($schools as $school)
                                                <option value="{{ $school->id }}" {{ request('school_id') == $school->id ? 'selected' : '' }}>
                                                    {{ $school->school_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-1 text1">
                                        From
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <input type="date" class="form-control" id="date_of_birth_from" name="date_of_birth_from" value="{{ request('date_of_birth_from') }}">
                                    </div>
                                    <div class="col-md-1 pl-5 text1">
                                        To
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <input type="date" class="form-control" id="date_of_birth_to" name="date_of_birth_to" value="{{ request('date_of_birth_to') }}">
                                    </div>

                                    <div class="col-md-3 mt-4">
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-12 text-center my-3">
                        <button type="button" onclick="urlFilter()" class="btn btn-primary">Filter</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Reset</a>
            </div>
            <div class="table-responsive">
                <div class="table-wrapper">
                    <table class="table table-hover table-bordered shadow-lg">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th class="img-column">Image</th>
                                <th class="img-column">Signature</th>
                                <th>Reg.No</th>
                                <th>Name</th>
                                <!-- <th>Father's Name</th>
                                <th>Mother's Name</th> -->
                                <th>Email</th>
                                <th>Phone No</th>
                                <th>Date of Birth</th>
                                <th>Gender</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Pin No</th>   
                            </tr>
                        </thead>
                        @if($students->isEmpty())
                            <tbody>
                                <tr>
                                    <td colspan="21" class="text-center text-muted">
                                        <p>No Record Found</p>
                                    </td>
                                </tr>
                            </tbody>
                        @else
                            <tbody id="students-table-body">
                                @foreach($students as $student)
                                    <tr id="student-row-{{ $student->id }}">
                                        <td>{{ $student->id }}</td>
                                        <td>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline; padding:0px;" id="delete-form-{{ $student->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $student->id }})">Delete</button>
                                            </form>

                                            <a href="{{ route('students.print', $student->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-print"></i> Print
                                            </a>
                                        </td>
                                        <td>
                                            @if($student->image)
                                                @php
                                                    // Generate the thumbnail name by appending '_thumbnail' to the original filename
                                                    $thumbnailImage = pathinfo($student->image, PATHINFO_FILENAME) . '_thumbnail.' . pathinfo($student->image, PATHINFO_EXTENSION);
                                                @endphp
                                                <img src="{{ asset('storage/students/images/thumbnails/' . $thumbnailImage) }}" alt="Student Image" class="img-thumbnail" 
                                                    data-bs-toggle="modal" data-bs-target="#imageModal" data-bs-image="{{ asset('storage/students/images/' . $student->image) }}" 
                                                    style="cursor: pointer;">
                                            @else
                                                No Image
                                            @endif
                                        </td>

                                        <td>
                                            @if($student->signature)
                                                @php
                                                    // Generate the thumbnail name by appending '_thumbnail' to the original signature filename
                                                    $thumbnailSignature = pathinfo($student->signature, PATHINFO_FILENAME) . '_thumbnail.' . pathinfo($student->signature, PATHINFO_EXTENSION);
                                                @endphp
                                                <img src="{{ asset('storage/students/signatures/thumbnails/' . $thumbnailSignature) }}" alt="Signature" class="img-thumbnail" 
                                                    data-bs-toggle="modal" data-bs-target="#signatureModal" data-bs-signature="{{ asset('storage/students/signatures/' . $student->signature) }}" 
                                                    style="cursor: pointer;">
                                            @else
                                                No Signature
                                            @endif
                                        </td>
                                        <td>{{ $student->registration_number }}</td>
                                        <td>{{ $student->name }}</td>
                                        <!-- <td>{{ $student->basicInformation->fathersname ?? 'N/A' }}</td>
                                        <td>{{ $student->basicInformation->mothersname ?? 'N/A' }}</td> -->
                                        <td>{{ $student->email }}</td>
                                        <td>{{ $student->phone_no }}</td>
                                        <td>{{ $student->basicInformation->date_of_birth ?? 'N/A' }}</td>
                                        <td>{{ $student->basicInformation->gender ?? 'N/A' }}</td>
                                        <td>{{ $student->address->country->country_name ?? 'N/A' }}</td>
                                        <td>{{ $student->address->state->state_name ?? 'N/A' }}</td>
                                        <td>{{ $student->address->district->district_name ?? 'N/A' }}</td>
                                        <td>{{ $student->address->pin_no ?? 'N/A' }}</td>     
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                    {!! $students->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Student Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modal-image" src="" alt="Student Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="signatureModal" tabindex="-1" aria-labelledby="signatureModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="signatureModalLabel">Student Signature</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modal-signature" src="" alt="Signature" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/all.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/alert.js') }}"></script>
        <script src="{{ asset('js/student.js') }}"></script>
        <script src="{{ asset('js/url.js') }}"></script>
        <div id="success-message" data-success="{{ session('success') }}"></div>
        <div id="error-message" data-error="{{ session('error') }}"></div>
    </body>
    </html>
</div>
