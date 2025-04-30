@include('layouts.navbar')
<div class="containers" style="padding-top: 60px;">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fees Details List</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/fees-detail.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="mx-auto" style="max-width: 600px;">
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4" style="padding-bottom: 5px; border-bottom: 3px double #2c3e50;">
            <h2 class="mb-0" style="padding-left: 40%">Fees Details List</h2>
            <a href="{{ route('fees-details.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Assign Fees
            </a>
        </div>

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
                        <label for="search" class="form-label">Search Fees Details by Any Criteria</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search.....">
                    </div>
                </div>
                @foreach(request()->except(['per_page', 'page']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
            </form>
        
            <div class="accordion" id="advancedFilterAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFilter">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                            Advance Filter
                        </button>
                    </h2>
                    
                    <div id="collapseFilter" class="accordion-collapse collapse" aria-labelledby="headingFilter">
                        <div class="accordion-body">
                            <form method="GET" action="{{ route('fees-details.list') }}" id="filter-form">
                                <div class="row mb-3 mx-0" style="background-color: #dfdfdd">
                                    <div class="col-md-3">
                                        <select name="course_id" id="course" class="form-control">
                                            <option value="">Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                    {{ $course->course_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select name="semester_id" id="semester" class="form-control">
                                            <option value="">Select Semester</option>
                                            @foreach($semesters as $semester)
                                                <option value="{{ $semester->id }}" {{ request('semester_id') == $semester->id ? 'selected' : '' }}>
                                                    {{ $semester->semester_no }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select name="academic_id" id="academic" class="form-control">
                                            <option value="">Select Academic Year</option>
                                            @foreach($academicYears as $academic)
                                                <option value="{{ $academic->id }}" {{ request('academic_id') == $academic->id ? 'selected' : '' }}>
                                                    {{ $academic->academic_year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <select name="fees_head_id" id="fees_head" class="form-control">
                                            <option value="">Select Fees Head</option>
                                            @foreach($feesHeads as $head)
                                                <option value="{{ $head->id }}" {{ request('fees_head_id') == $head->id ? 'selected' : '' }}>
                                                    {{ $head->name }}
                                                </option>
                                            @endforeach
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
                        <a href="{{ route('fees-details.list') }}" class="btn btn-secondary">Reset</a>
            </div>
            
            <div class="table-responsive">
                <div class="table-wrapper">
                    <table class="table table-hover table-bordered shadow-lg">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Actions</th>
                                <th>Academic Year</th>
                                <th>Course</th>
                                <th>Semester</th>
                                <th>Tuition fees</th>
                                <th>Library fees</th>
                                <th>Exam fees</th>
                                <th>Admission fees</th>
                                <th>Lab fees</th>
                                <th>Health services fees</th>
                                <th>Total Amount</th>
                                
                            </tr>
                        </thead>
                            @if($feesStructures->isEmpty())

                                <tbody>
                                    <tr>
                                        <td colspan="12" class="text-center text-muted">
                                            <p>No Record Found</p>
                                        </td>
                                    </tr>
                                </tbody>
                            @else
                        <tbody>
                             @foreach($feesStructures as $index => $structure)
                                @php
                                    $feesByHead = $structure->feesDetails->keyBy('fees_head_id');
                                @endphp
                                <tr>
                                    <td>{{ ($feesStructures->currentPage() - 1) * $feesStructures->perPage() + $index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('fees-details.edit', $structure->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="{{ route('fees-details.print', $structure->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i> Print
                                        </a>
                                    </td>
                                    <td>{{ $structure->academicYear->academic_year ?? 'N/A' }}</td>
                                    <td>{{ $structure->course->course_name ?? 'N/A' }}</td>
                                    <td>{{ $structure->semester->semester_no ?? 'N/A' }}</td>

                                    <td>{{ $feesByHead->get(1)?->amount ?? '-' }}</td> {{-- Tuition fees --}}
                                    <td>{{ $feesByHead->get(2)?->amount ?? '-' }}</td> {{-- Library fees --}}
                                    <td>{{ $feesByHead->get(3)?->amount ?? '-' }}</td> {{-- Exam fees --}}
                                    <td>{{ $feesByHead->get(4)?->amount ?? '-' }}</td> {{-- Admission fees --}}
                                    <td>{{ $feesByHead->get(5)?->amount ?? '-' }}</td> {{-- Lab fees --}}
                                    <td>{{ $feesByHead->get(6)?->amount ?? '-' }}</td> {{-- Health services fees --}}
                                    <td>{{ $structure->total_amount ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        @endif
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                    {!! $feesStructures->links('pagination::bootstrap-5') !!}

                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/all.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/alert.js') }}"></script>
        <script src="{{ asset('js/fees.js') }}"></script>
        <script src="{{ asset('js/fees-url.js') }}"></script>
        <div id="success-message" data-success="{{ session('success') }}"></div>
        <div id="error-message" data-error="{{ session('error') }}"></div>
    </body>
    </html>
</div>
