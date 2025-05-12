<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Set Fees Payment Schedule</title>
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

        .form-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-row .col-md-4 {
            flex: 1;
            min-width: 250px;
        }

        .form-group {
            margin-bottom: 20px;
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

        .schedule-section .form-control {
            width: 100%;
        }

        .schedule-header {
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 25px;
            font-size: 22px;
        }

        .btn-primary, .btn-info {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-primary {
            background: #7e22ce;
            border: none;
        }

        .btn-info {
            background: #3b82f6;
            border: none;
        }

        .btn-primary:hover, .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            border: 1px solid #22c55e;
            border-radius: 12px;
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
    <h2 style="border-bottom: 3px solid rgba(255, 255, 255, 0.3); padding-bottom: 8px;">Set Fees Payment Schedule</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('fees-payment-schedules.feesScheduleStore') }}" method="POST">
        @csrf

        <div class="form-row mb-4">
            <div class="col-md-4 form-group">
                <label class="date-label">Academic Year</label>
                <select name="academic_id" class="form-select" required>
                    <option value="">Select Academic Year</option>
                    @foreach($academicYears as $academic)
                        <option value="{{ $academic->id }}">{{ $academic->academic_year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label class="date-label">Course</label>
                <select name="course_id" class="form-select" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label class="date-label">Semester</label>
                <select name="semester_id" class="form-select" required>
                    <option value="">Select Semester</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->semester_no }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="text-center mt-3">
            <button type="button" class="btn btn-info" id="loadScheduleBtn">Load Schedule</button>
        </div>

        <div id="schedule-container" class="schedule-section d-none mt-4">
            <h4 class="schedule-header">Set Schedule</h4>
            <div class="row g-3 align-items-end">
                <div class="col-md form-group">
                    <label for="start_date" class="date-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="col-md form-group">
                    <label for="end_date" class="date-label">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <div class="col-md form-group">
                    <label for="extended_date" class="date-label">Extended Date</label>
                    <input type="date" name="extended_date" id="extended_date" class="form-control">
                </div>
                <div class="col-md form-group">
                    <label for="late_fine" class="date-label">Late Fine (₹)</label>
                    <input type="number" name="late_fine" id="late_fine" class="form-control" min="0" step="0.01">
                </div>
                <div class="col-md form-group">
                    <label for="payment" class="date-label">Total Amount (₹)</label>
                    <input type="number" name="payment" id="payment" class="form-control" min="0" step="0.01" required>
                </div>
            </div>
            <div class="mt-3 form-group">
                <label for="description" class="date-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-4 d-block mx-auto">Save Schedule</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    $('#loadScheduleBtn').click(function () {
        let academic = $('select[name="academic_id"]').val();
        let course = $('select[name="course_id"]').val();
        let semester = $('select[name="semester_id"]').val();

        if (academic && course && semester) {
            $.ajax({
                url: '{{ route("check.fees.structure") }}',
                method: 'POST',
                data: {
                    academic_id: academic,
                    course_id: course,
                    semester_id: semester,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.exists) {
                        if (response.scheduled) {
                            $('#schedule-container').addClass('d-none');
                            Swal.fire({
                                icon: 'warning',
                                title: 'Already Scheduled',
                                text: 'Payment has already been scheduled for this structure.'
                            });
                        } else {
                            $('#payment').val(response.total_amount);
                            $('#schedule-container').removeClass('d-none');
                            $('html, body').animate({
                                scrollTop: $('#schedule-container').offset().top
                            }, 500);
                        }
                    } else {
                        $('#schedule-container').addClass('d-none');
                        Swal.fire({
                            icon: 'info',
                            title: "Don't have any fees to Schedule",
                            text: 'No record found in the fees structure table for selected inputs.'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong while checking the fees structure.'
                    });
                }
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Please select all fields',
                text: 'Academic Year, Course, and Semester are required.'
            });
        }
    });
});

</script>
</body>
</html>