<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <style>
        .navbar {
            background: linear-gradient(135deg,rgb(88, 94, 100),rgb(0, 0, 0));
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .nav-link, .navbar-brand {
            color: #fff !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: #fff;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .logout-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: #fff !important;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }

        body {
            padding-top: 70px;
        }
    </style>
</head>
<body class="bg-light">

<!-- Navigation Bar -->
<!-- Navigation Bar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <i class="navbar-brand">
            <i class="bi bi-people-fill me-2"></i>Student Management
        </i>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center gap-5">
                <a class="nav-link" href="{{ route('admin.panel') }}">Home</a>
                <a class="nav-link" href="{{ route('students.index') }}">Students List</a>
                
                <!-- Fees Management Button (Trigger Modal) -->
                <button class="nav-link btn" data-bs-toggle="modal" data-bs-target="#feesManagementModal">Fees Management</button>

                <form action="{{ route('adminlogout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Fees Management Modal -->
<div class="modal fade" id="feesManagementModal" tabindex="-1" aria-labelledby="feesManagementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feesManagementModalLabel">Fees Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Select one of the options below:</p>
                <a href="{{ route('fees-details.create') }}" class="btn btn-primary w-100 mb-2">Assign Fees</a>
                <a href="{{ route('fees-details.edit') }}" class="btn btn-warning w-100">Edit Fees</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle JS -->


</body>
</html>
