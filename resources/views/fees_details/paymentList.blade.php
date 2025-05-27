@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Payment List</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fees-detail.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #E8ECEF;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
        }

        .containers {
            padding-top: 60px;
        }

        .container {

            margin: 0 auto;
        }

        h2 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: #004D40;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .header-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-border {
            padding-bottom: 8px;
            border-bottom: 4px solid #00897B;
            width: 100%;
            max-width: 600px;
            text-align: center;
        }
        form{
          background: #cadcda;
        }

        .form-select, .form-control {
            border-radius: 6px;
            border: 1px solid #B0BEC5;
            transition: all 0.3s ease;
        }

        .form-select:hover, .form-control:hover {
            border-color: #00897B;
        }

        .form-select:focus, .form-control:focus {
            border-color: #00897B;
            box-shadow: 0 0 6px rgba(0, 137, 123, 0.3);
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .table {
            margin-bottom: 0;
            background: #fff;
        }

        .table th {
            font-weight: 500;
            vertical-align: middle;
            background: linear-gradient(45deg, #00897B, #4DB6AC);
            color: #fff;
        }

        .table td {
            vertical-align: middle;
            padding: 14px;
        }

        .table-hover tbody tr:hover {
            background: #F5F7FA;
        }

        .table tbody tr:nth-child(even) {
            background: #FAFAFA;
        }

        .btn-primary {
            background: #00897B;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #00695C;
            transform: scale(1.05);
        }

        .btn-secondary {
            background: #607D8B;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #455A64;
            transform: scale(1.05);
        }

        .btn-info {
            background: #26A69A;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-info:hover {
            background: #00897B;
            transform: scale(1.05);
        }

        .accordion-button {
            background: #00695C;
            color: #020202;
            font-weight: 500;
            border-radius: 6px 6px 0 0;
        }

        .accordion-button:not(.collapsed) {
            background-color: #fff !important;
            color: #020202;
        }

    .accordion-button:hover {
        background-color: #fff!important;
        transform: translateY(-1px);
    }
        .accordion-body {
            background: #ECEFF1;
            padding: 20px;
            border-radius: 0 0 6px 6px;
        }

        .pagination .page-link {
            color: #00897B;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: #00897B;
            color: #fff;
        }

        .pagination .page-item.active .page-link {
            background: #00897B;
            border-color: #00897B;
            color: #fff;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .container { padding: 0 10px; }
            .row.align-items-end { flex-wrap: wrap; gap: 12px; }
            .col-md-2, .col-md-3, .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .d-flex.gap-2 { flex-direction: column; gap: 12px; }
        }

        @media (max-width: 768px) {
            h2 { font-size: 1.6rem; }
            .table th, .table td { font-size: 0.85rem; padding: 10px; }
            .form-select, .form-control { font-size: 0.85rem; }
            .btn { padding: 8px 16px; font-size: 0.85rem; }
            .accordion-body { padding: 15px; }
            .header-border { max-width: 100%; }
        }

        @media (max-width: 576px) {
            .table { font-size: 0.8rem; }
            .table th, .table td { padding: 8px; }
            .header-border { padding-bottom: 6px; }
            .form-label { font-size: 0.8rem; }
            .pagination .page-link { padding: 4px 8px; font-size: 0.8rem; }
        }
    </style>
</head>
<body>
<div class="containers">
    <div class="container" style="background: #e6fcfa">
        <div class="header-container">
            <div class="header-border">
                <h2 class="mb-0">All Payments</h2>
            </div>
        </div>

        <form method="GET" action="{{ route('payment.list') }}" class="mb-3">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2" style="background: #e6fcfa;">
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
                    <label for="search" class="form-label">Search Payments by Any Criteria</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search...">
                </div>
            </div>
            @foreach(request()->except(['per_page', 'page', 'search', 'course_id', 'semester_id', 'academic_id', 'start_date', 'end_date']) as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
        </form>

        <div class="accordion" id="advancedFilterAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFilter">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                        Advanced Filter
                    </button>
                </h2>
                <div id="collapseFilter" class="accordion-collapse collapse" aria-labelledby="headingFilter">
                    <div class="accordion-body" style="background: #cadcda;">
                        <form method="GET" action="{{ route('payment.list') }}" id="filter-form">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="course_id" class="form-label">Course</label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="semester_id" class="form-label">Semester</label>
                                    <select name="semester_id" id="semester_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{ $semester->id }}" {{ request('semester_id') == $semester->id ? 'selected' : '' }}>
                                                {{ $semester->semester_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="academic_id" class="form-label">Academic Year</label>
                                    <select name="academic_id" id="academic_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach($academicYears as $year)
                                            <option value="{{ $year->id }}" {{ request('academic_id') == $year->id ? 'selected' : '' }}>
                                                {{ $year->academic_year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ request('end_date') }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center my-3">
            <button type="submit" class="btn btn-primary" form="filter-form">Filter</button>
            <a href="{{ route('payment.list') }}" class="btn btn-secondary">Reset</a>
        </div>

        <div class="table-responsive mt-4">
            <table class="table table-hover table-bordered">
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
                            <td style="text-align: right;">{{ ($payments->currentPage() - 1) * $payments->perPage() + $index + 1 }}</td>
                            <td>
                                <a href="{{ url('/print-invoice/' . $payment->student->id . '/' . $payment->fees_structure_id) }}" target="_blank" class="btn btn-sm btn-info" title="Print Invoice">
                                    <i class="fa fa-print"></i>
                                </a>
                            </td>
                            <td style="text-align: left;">{{ $payment->student->name ?? 'N/A' }}</td>
                            <td>{{ $payment->student->registration_number ?? 'N/A' }}</td>
                            <td style="text-align: left;">{{ $payment->feesStructure->structure_name ?? 'N/A' }}</td>
                            <td style="text-align: right;">₹{{ number_format($payment->total_amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No payment records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {!! $payments->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/paymentList-url.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const success = document.getElementById('success-message').dataset.success;
        const error = document.getElementById('error-message').dataset.error;

        if (success) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: success,
                timer: 3000,
                showConfirmButton: false
            });
        }

        if (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error,
                timer: 3000,
                showConfirmButton: false
            });
        }
    });
</script>

<div id="success-message" data-success="{{ session('success') }}"></div>
<div id="error-message" data-error="{{ session('error') }}"></div>
</body>
</html>