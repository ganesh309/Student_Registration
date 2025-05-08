@include('layouts.navbar')
<link href="{{ asset('css/fees-detail.css') }}" rel="stylesheet">

<div class="containers" style="padding-top: 60px;">
    <div class="container">
        <div class="mx-auto" style="max-width: 600px;"></div>

        <div class="d-flex justify-content-between align-items-center mb-4" style="padding-bottom: 5px; border-bottom: 3px double #2c3e50;">
            <h2 class="mb-0" style="padding-left: 30%;">Fees Payment Schedule List</h2>
            <a href="{{ route('fees-details.schedule') }}" class="btn btn-success">
                <i class="fas fa-plus-circle"></i> Add Schedule
            </a>
        </div>

        {{-- Search & Per Page Filter --}}
        <form method="GET" action="{{ url()->current() }}" class="mb-3">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
                <div>
                    <label for="per_page" class="form-label">Records per page:</label>
                    <select name="per_page" id="per_page" class="form-select form-select-sm">
                        @foreach([5, 10, 25, 50, 100] as $limit)
                            <option value="{{ $limit }}" {{ request('per_page') == $limit ? 'selected' : '' }}>{{ $limit }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="search" class="form-label">Search Fees Schedule by Any Criteria</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search.....">
                </div>
            </div>

            {{-- Preserve other filters --}}
            @foreach(request()->except(['per_page', 'page', 'search']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>

        {{-- Advanced Filter Accordion --}}
        <div class="accordion" id="advancedFilterAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFilter">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                        Advanced Filter
                    </button>
                </h2>
                <div id="collapseFilter" class="accordion-collapse collapse" aria-labelledby="headingFilter">
                    <div class="accordion-body">
                        <form method="GET" action="{{ route('fees-schedules.list') }}" id="filter-form">
                            <div class="row mb-3 mx-0" style="background-color: #dfdfdd; padding: 10px;">
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
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                                </div>

                                <div class="col-md-3 mt-2 mt-md-0">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                                </div>
                            </div>

                            {{-- Filter Buttons moved outside below --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Buttons Outside Accordion --}}
        <div class="text-center my-3">
            <button type="submit" class="btn btn-primary" form="filter-form">Filter</button>
            <a href="{{ route('fees-schedules.list') }}" class="btn btn-secondary">Reset</a>
        </div>

        {{-- Table Section --}}
        <div class="table-responsive mt-4">
            <table class="table table-hover table-bordered shadow-lg">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Actions</th>
                        <th>Structure Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Extended Date</th>
                        <th>Late Fine (₹)</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $index => $schedule)
                        <tr>
                            <td style="text-align: right;">{{ ($schedules->currentPage() - 1) * $schedules->perPage() + $index + 1 }}</td>
                            <td>
                                <a href="{{ route('fees-schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </td>
                            <td>{{ $schedule->structure->structure_name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}</td>
                            <td>{{ $schedule->extended_date ? \Carbon\Carbon::parse($schedule->extended_date)->format('d M Y') : '-' }}</td>
                            <td style="text-align: right;">₹{{ number_format($schedule->late_fine, 2) }}</td>
                            <td style="text-align: left;">{{ $schedule->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No Records Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-3">
                {!! $schedules->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>

{{-- JS Scripts --}}
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/fees-schedule-url.js') }}"></script>
<script src="{{ asset('js/fees.js') }}"></script>

{{-- Flash Messages --}}
<div id="success-message" data-success="{{ session('success') }}"></div>
<div id="error-message" data-error="{{ session('error') }}"></div>
