<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Fees Structure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: url('/images/background1.jpg') no-repeat center center fixed;
            min-height: 100vh;
            padding: 40px;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background: #ebebeb;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .fees-section {
            background: rgb(250 253 255 / 90%);
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            max-width: 800px;      
            margin: 0 auto;    
        }

        .fees-entry {
            transition: all 0.3s ease;
        }

        .fees-header {
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .fees-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            align-items: flex-end;
        }

        .fees-input-group {
            flex: 1;
        }

        .remove-fee {
            margin-bottom: 10px;
        }

        .fees-input {
            padding: 10px 15px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            font-size: 15px;
        }

        .fees-input:focus {
            border-color: #667eea;
            outline: none;
        }

        .remove-fee {
            margin-left: 10px;
        }

        .btn-success, .btn-primary {
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-danger {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
        }

        /* Responsive behavior */
        @media (max-width: 768px) {
            .fees-row {
                flex-direction: column;
            }

            .remove-fee {
                align-self: flex-start;
                margin-left: 0;
                margin-top: 10px;
            }
        }

        /* New styles for reducing field size and placing them in a row */
        .form-select, .fees-input {
            width: 100%;
            max-width: 250px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
        }

        .form-row .col-md-4 {
            max-width: 250px; /* Reduce width */
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container">
        <h2>Edit Fees Structure</h2>

        <form action="{{ route('fees-details.update', $feesStructure->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Course, Semester, Academic Year Selection -->
            <div class="form-row mb-4">
                <div class="col-md-4">
                    <label class="form-label">Course</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ $feesStructure->course_id == $course->id ? 'selected' : '' }}>
                                {{ $course->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Semester</label>
                    <select name="semester_id" class="form-select" required>
                        <option value="">Select Semester</option>
                        @foreach($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ $feesStructure->semester_id == $semester->id ? 'selected' : '' }}>
                                {{ $semester->semester_no }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Academic Year</label>
                    <select name="academic_id" class="form-select" required>
                        <option value="">Select Academic Year</option>
                        @foreach($academicYears as $academic)
                            <option value="{{ $academic->id }}" {{ $feesStructure->academic_id == $academic->id ? 'selected' : '' }}>
                                {{ $academic->academic_year }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Fees Details Section -->
            <div class="fees-section">
                <h4 class="fees-header">Fees Details</h4>

                <div id="fees-container">
                    @foreach($feesStructure->feesDetails as $detail)
                        <div class="fees-row fees-entry align-items-end">
                            <div class="fees-input-group">
                                <label>Fees Head</label>
                                <select class="fees-input" name="fees_head_id[]" required>
                                    <option value="">Select Fees Head</option>
                                    @foreach($feesHeads as $head)
                                        <option value="{{ $head->id }}" {{ $detail->fees_head_id == $head->id ? 'selected' : '' }}>
                                            {{ $head->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fees-input-group">
                                <label>Amount</label>
                                <input type="number" class="fees-input" name="amount[]" value="{{ $detail->amount }}" placeholder="Enter amount" required>
                            </div>

                            <button type="button" class="btn btn-danger remove-fee ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zM4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="add-more" class="btn btn-success mt-3">
                    + Add More
                </button>
            </div>

            <div class="text-center mt-4">
    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
    <a href="{{ route('fees-details.list') }}" class="btn btn-secondary" style="background-color: gray; color: white;">
        Back
    </a>
</div>

        </form>
    </div>

    <script>
        $(document).ready(function () {
            // Add new fee entry with animation
            $('#add-more').click(function () {
                const newEntry = $('.fees-entry:first').clone();
                newEntry.hide(); // Hide before appending
                newEntry.find('input').val('');
                newEntry.find('select').prop('selectedIndex', 0);
                $('#fees-container').append(newEntry);
                newEntry.slideDown(); // Animate appearance
            });

            // Remove fee entry with animation
            $(document).on('click', '.remove-fee', function () {
                if ($('.fees-entry').length > 1) {
                    $(this).closest('.fees-entry').slideUp(300, function () {
                        $(this).remove();
                    });
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
