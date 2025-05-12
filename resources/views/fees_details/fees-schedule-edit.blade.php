<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Fees Payment Schedule</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            background: url('/images/background1.jpg') no-repeat center center fixed;
            min-height: 100vh;
            padding: 40px;
            font-family: 'Inter', sans-serif;
            color: #1f2937;
        }

        .container {
            background: rgb(181 206 242 / 84%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 40px;
            max-width: 1100px;
            margin: auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        h2 {
            color: #ffffff;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .form-select, .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-select:focus, .form-control:focus {
            border-color: #7e22ce;
            box-shadow: 0 0 8px rgba(126, 34, 206, 0.3);
            outline: none;
        }

        .date-label {
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }

        .schedule-section {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .schedule-header {
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 25px;
            font-size: 22px;
        }

        .btn-primary {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            background: #7e22ce;
            border: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .form-row .col-md-4 {
                min-width: 100%;
            }

            .schedule-section .row {
                flex-direction: column;
            }

            .schedule-section .col-md {
                width: 100%;
                margin-bottom: 15px;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="container">
    <h2>Edit Fees Payment Schedule</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('fees-payment-schedules.update', $feesPaymentSchedule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-4">
            <div class="col-md-4">
                <label class="date-label">Academic Year</label>
                <select class="form-select" disabled>
                    @foreach($academicYears as $academic)
                    <option value="{{ $academic->id }}" {{ $feesPaymentSchedule->structure->academic_id == $academic->id ? 'selected' : '' }}>
                        {{ $academic->academic_year }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="date-label">Course</label>
                <select class="form-select" disabled>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $feesPaymentSchedule->structure->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="date-label">Semester</label>
                <select class="form-select" disabled>
                    @foreach($semesters as $semester)
                    <option value="{{ $semester->id }}" {{ $feesPaymentSchedule->structure->semester_id == $semester->id ? 'selected' : '' }}>
                        {{ $semester->semester_no }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="schedule-section">
            <h4 class="schedule-header">Edit Schedule</h4>
            <div class="row g-3 align-items-end">
                <div class="col-md form-group">
                    <label for="start_date" class="date-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                           value="{{ $feesPaymentSchedule->start_date }}" required>
                </div>
                <div class="col-md form-group">
                    <label for="end_date" class="date-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control"
                           value="{{ $feesPaymentSchedule->end_date }}" required>
                </div>
                <div class="col-md form-group">
                    <label for="extended_date" class="date-label">Extended Date</label>
                    <input type="date" name="extended_date" id="extended_date" class="form-control"
                           value="{{ $feesPaymentSchedule->extended_date }}">
                </div>
                <div class="col-md form-group">
                    <label for="late_fine" class="date-label">Late Fine (₹)</label>
                    <input type="number" name="late_fine" id="late_fine" class="form-control"
                           value="{{ $feesPaymentSchedule->late_fine }}" min="0" step="0.01">
                </div>
                <div class="col-md form-group">
                    <label for="payment" class="date-label">Total Amount (₹)</label>
                    <input type="number" class="form-control" value="{{ $feesPaymentSchedule->structure->total_amount }}" disabled>
                </div>
            </div>
            <div class="mt-3 form-group">
                <label for="description" class="date-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ $feesPaymentSchedule->description }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4 d-block mx-auto">Update Schedule</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
