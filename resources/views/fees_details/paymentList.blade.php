@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Payment List</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container" style="padding-top: 60px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-center w-100">All Payments</h2>
        <a href="#" class="btn btn-success d-none">Add New</a> <!-- Hidden if no use -->
    </div>

    <!-- Filter + Search -->
    <form method="GET" action="{{ url()->current() }}" class="mb-4">
        <div class="row align-items-end">
            <div class="col-md-2">
                <label for="per_page" class="form-label">Records/Page:</label>
                <select name="per_page" id="per_page" class="form-select">
                    @foreach([5, 10, 25, 50, 100] as $limit)
                        <option value="{{ $limit }}" {{ request('per_page') == $limit ? 'selected' : '' }}>
                            {{ $limit }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="search" class="form-label">Search</label>
                <input type="text" class="form-control" name="search" id="search" placeholder="Search..." value="{{ request('search') }}">
            </div>

            <div class="col-md-2">
                <label for="course_id" class="form-label">Course</label>
                <select name="course_id" class="form-select">
                    <option value="">All</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="semester_id" class="form-label">Semester</label>
                <select name="semester_id" class="form-select">
                    <option value="">All</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ request('semester_id') == $semester->id ? 'selected' : '' }}>
                            {{ $semester->semester_no }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="academic_id" class="form-label">Academic Year</label>
                <select name="academic_id" class="form-select">
                    <option value="">All</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year->id }}" {{ request('academic_id') == $year->id ? 'selected' : '' }}>
                            {{ $year->academic_year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 mt-3">
                <label>Date Range</label>
                <div class="d-flex gap-2">
                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
            </div>

            <div class="col-md-3 mt-3">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('payment.list') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Student Name</th>
                    <th>Reg. No</th>
                    <th>Fees Name</th>
                    <th>Paid Amount (₹)</th>
                    <th>Payment Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $index => $payment)
                    <tr>
                        <td>{{ ($payments->currentPage() - 1) * $payments->perPage() + $index + 1 }}</td>
                        <td>
                            <a href="{{ url('/print-invoice/' . $payment->student->id . '/' . $payment->fees_structure_id) }}" target="_blank" title="Print Invoice">
                                <i class="fa fa-print" style="font-size: 18px;"></i>
                            </a>
                        </td> 
                        <td>{{ $payment->student->name ?? 'N/A' }}</td>
                        <td>{{ $payment->student->registration_number ?? 'N/A' }}</td>
                        <td>{{ $payment->feesStructure->structure_name ?? 'N/A' }}</td>
                        <td style="text-align: right;">₹{{ number_format($payment->total_amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No payment records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {!! $payments->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
</body>
</html>
