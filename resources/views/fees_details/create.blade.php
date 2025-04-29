
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Fees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .gradient-bg {
            background: url('/images/background1.jpg') no-repeat center center fixed;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .card-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, #3f87a6, #2c3e50);
        }
        .form-floating > label {
            padding: 0.75rem 1.25rem;
            color: #495057;
            transition: all 0.2s ease;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
        }
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(63, 135, 166, 0.15);
            border-color: #3f87a6;
        }
        .btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }
        .btn-success {
            background: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
        }
        .btn-danger {
            background: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);
        }
        .fees-entry {
            background: #fff;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.25rem;
            opacity: 1;
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .fees-entry.removing {
            opacity: 0;
            transform: translateX(-50px);
            margin-bottom: 0;
            padding: 0;
            height: 0;
        }
        .fees-entry.adding {
            opacity: 0;
            transform: translateY(20px);
        }
        .remove-fee {
            transition: all 0.2s ease;
            transform: scale(1);
        }
        .remove-fee:hover {
            transform: scale(1.05);
        }
        .alert-success {
            background: rgba(40, 167, 69, 0.15);
            border: 1px solid rgba(40, 167, 69, 0.2);
            color: #28a745;
        }
        @keyframes gentleAppear {
            0% { opacity: 0; transform: translateY(10px) scale(0.98); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        .animate-entry {
            animation: gentleAppear 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="gradient-bg ">class="d-flex flex-column min-vh-100 bg-light"
@include('layouts.navbar')
<div class="container mt-4">
    <div class="card animate__animated animate__fadeInUp">
        <div class="card-header text-white">
            <h2 class="mb-0">Assign Fees to Course and Academic Year</h2>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Place inside .card-body, above #fees-container -->

<form action="{{ route('fees-details.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="form-floating">
                <select name="course_id" class="form-select" id="course_id" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                </select>
                <label for="course_id">Course</label>
            </div>
        </div>
        

        <div class="col-md-6">
            <div class="form-floating">
                <select name="academic_id" class="form-select" id="academic_id" required>
                    <option value="">Select Academic Year</option>
                    @foreach($academicYears as $academic)
                        <option value="{{ $academic->id }}">{{ $academic->academic_year }}</option>
                    @endforeach
                </select>
                <label for="academic_id">Academic Year</label>
            </div>
        </div>
    </div>

    <!-- Fee Entries Start -->
    <div id="fees-container">
        <div class="fees-entry row g-3 align-items-end animate-entry">
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="fees_head_id[]" class="form-select" required>
                        <option value="">Select Fees Head</option>
                        @foreach($feesHeads as $head)
                            <option value="{{ $head->id }}">{{ $head->name }}</option>
                        @endforeach
                    </select>
                    <label>Fees Head</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-floating">
                    <input type="number" name="amount[]" class="form-control" placeholder="Amount" required>
                    <label>Amount</label>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-center">
                <button type="button" class="btn btn-danger remove-fee p-2">
                    <!-- SVG Trash Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3 mt-4">
        <button type="button" id="add-more" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>
            Add More
        </button>
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 0 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
            </svg>
            Assign Fees
        </button>
    </div>
</form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Add new fee entry
        $('#add-more').click(function () {
            const newEntry = $('.fees-entry:first').clone()
                .removeClass('animate-entry')
                .addClass('adding')
                .css('opacity', 0);

            // Clear inputs/selects relevant to fees
            newEntry.find('input').val('');
            newEntry.find('select').prop('selectedIndex', 0);

            $('#fees-container').append(newEntry);

            setTimeout(() => {
                newEntry.removeClass('adding')
                    .css('opacity', 1)
                    .addClass('animate-entry');
            }, 10);
        });

        // Remove fee entry (must use 'on' for dynamic elements)
        $(document).on('click', '.remove-fee', function () {
            if ($('.fees-entry').length > 1) {
                const entry = $(this).closest('.fees-entry');
                entry.addClass('removing');
                setTimeout(() => entry.remove(), 400);
            }
        });
    });
</script>


</body>
</html>