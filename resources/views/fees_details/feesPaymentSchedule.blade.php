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
            max-width: 720px;
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
        .schedule-header {
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 25px;
            font-size: 22px;
        }
        .btn-primary, .btn-info, .btn-secondary {
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
        .btn-secondary {
            background: #6c757d;
            border: none;
        }
        .btn-primary:hover, .btn-info:hover, .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
            border: 1px solid #22c55e;
            border-radius: 12px;
        }
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="container" style="width: 50%;">
    <h2 style="border-bottom: 3px solid rgba(255, 255, 255, 0.3); padding-bottom: 8px;">Set Fees Payment Schedule</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('fees-payment-schedules.feesScheduleStore') }}" method="POST">
        @csrf
        <div id="initial-section">
            <div class="row mb-4">
                <div class="col-md-6 form-group">
                    <label class="date-label">Fees Structure</label>
                    <select name="structure_id" class="form-select" required>
                        <option value="">Select Fees Structure</option>
                        @foreach($structures as $structure)
                            <option value="{{ $structure->id }}">{{ $structure->structure_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="payment" class="date-label">Total Amount (₹)</label>
                    <input type="number" name="payment" id="payment" class="form-control" min="0" step="0.01" readonly required>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="button" class="btn btn-info" id="loadScheduleBtn">Next</button>
            </div>
        </div>

        <div id="schedule-container" class="schedule-section d-none mt-4">
            <h4 class="schedule-header">Set Schedule</h4>

            <div class="form-group mb-3">
                <label for="start_date" class="date-label">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="end_date" class="date-label">End Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="extended_date" class="date-label">Extended Date</label>
                <input type="date" name="extended_date" id="extended_date" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="late_fine" class="date-label">Late Fine (₹)</label>
                <input type="number" name="late_fine" id="late_fine" class="form-control" min="0" step="0.01">
            </div>

            <div class="form-group mb-3">
                <label for="description" class="date-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" id="backBtn">Back</button>
                <button type="submit" id="saveScheduleBtn" class="btn btn-primary">Save Schedule</button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        $('select[name="structure_id"]').change(function () {
            let structureId = $(this).val();
            if (structureId) {
                $.ajax({
                    url: '{{ route("get.structure.amount") }}',
                    method: 'POST',
                    data: {
                        structure_id: structureId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.total_amount !== null) {
                            $('#payment').val(response.total_amount);
                        } else {
                            $('#payment').val('');
                            Swal.fire({
                                icon: 'info',
                                title: 'Amount Not Found',
                                text: 'No amount found for selected structure.'
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Error while fetching the amount.'
                        });
                    }
                });
            } else {
                $('#payment').val('');
            }
        });

        $('#loadScheduleBtn').click(function () {
            let structureId = $('select[name="structure_id"]').val();

            if (structureId) {
                $.ajax({
                    url: '{{ route("check.structure.schedule") }}',
                    method: 'POST',
                    data: {
                        structure_id: structureId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.scheduled) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Already Scheduled',
                                text: 'A payment schedule already exists for this structure.'
                            });
                        } else {
                            $('#initial-section').addClass('d-none');
                            $('#schedule-container').removeClass('d-none');
                            $('html, body').animate({
                                scrollTop: $('#schedule-container').offset().top
                            }, 500);
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong while checking the schedule.'
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Please select a structure',
                    text: 'You must choose a Fees Structure before proceeding.'
                });
            }
        });

        // Back button
        $('#backBtn').click(function () {
            $('#schedule-container').addClass('d-none');
            $('#initial-section').removeClass('d-block').removeClass('d-none').addClass('d-block');
            $('html, body').animate({
                scrollTop: $('#initial-section').offset().top
            }, 500);
        });
    });
</script>

</body>
</html>
