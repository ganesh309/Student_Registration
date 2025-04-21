<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        .navbar-container {
            position: fixed;
            top: 20px;
            left: 20px;
            width: 250px;
            height: 70px;
            perspective: 1000px;
            z-index: 1000;
            transition: all 0.5s ease;
        }

        .navbar {
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #2c3e50, #34495e);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transform-style: preserve-3d;
            transition: all 0.5s ease;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: #fff;
        }

        .navbar:hover {
            transform: rotateX(10deg) translateZ(20px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .navbar.collapsed {
            transform: rotateX(0deg) translateZ(0);
        }

        .navbar .title {
            font-size: 1.2rem;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .navbar .toggle-icon i {
            font-size: 1.5rem;
            transition: transform 0.3s ease;
        }

        .navbar.expanded .toggle-icon i {
            transform: rotate(180deg);
        }

        .sidebar {
            position: fixed;
            top: 100px;
            left: 20px;
            width: 250px;
            background: linear-gradient(to bottom, #34495e, #1a252f);
            color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.3);
            height: calc(100% - 120px);
            transition: transform 0.5s ease, opacity 0.3s ease;
            transform: translateY(-100%) translateZ(-50px);
            opacity: 0;
            transform-style: preserve-3d;
        }

        .sidebar.expanded {
            transform: translateY(0) translateZ(0);
            opacity: 1;
        }

        .sidebar h4 {
            font-size: 1.5rem;
            margin-bottom: 30px;
            text-align: center;
            color: #ecf0f1;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
            animation: glow 2s infinite alternate;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px;
            color: #bdc3c7;
            text-decoration: none;
            margin: 15px 0;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
            transform-style: preserve-3d;
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 1.3rem;
            transition: all 0.4s ease;
        }

        .sidebar a:hover {
            background: linear-gradient(45deg, #3498db, #2980b9);
            color: #fff;
            transform: perspective(600px) rotateY(15deg) translateZ(30px) scale(1.05);
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.4);
        }

        .sidebar a:hover i {
            transform: scale(1.3) rotate(10deg);
            color: #ecf0f1;
        }

        .sidebar a:active {
            transform: perspective(600px) rotateY(0deg) scale(0.95);
        }

        .content {
            flex-grow: 1;
            padding: 40px;
            margin-left: 290px;
            background: #fff;
            border-radius: 15px 0 0 15px;
            box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.1);
            transition: margin-left 0.5s ease;
        }

        .content.expanded {
            margin-left: 0;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            width: 210px;
        }

        .logout button {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #bdc3c7;
            font-size: 1.1rem;
            padding: 15px;
            width: 100%;
            text-align: left;
            border-radius: 10px;
            display: flex;
            align-items: center;
            transition: all 0.4s ease;
            transform-style: preserve-3d;
        }

        .logout button i {
            margin-right: 15px;
            font-size: 1.3rem;
            transition: all 0.4s ease;
        }

        .logout button:hover {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: #fff;
            transform: perspective(600px) rotateY(15deg) translateZ(30px);
        }

        .logout button:hover i {
            transform: scale(1.3) rotate(-10deg);
        }

        @keyframes glow {
            from { text-shadow: 0 0 5px rgba(52, 152, 219, 0.5); }
            to { text-shadow: 0 0 15px rgba(52, 152, 219, 1); }
        }

        @keyframes float {
            0% { transform: translateZ(0) rotateX(0deg); }
            50% { transform: translateZ(20px) rotateX(5deg); }
            100% { transform: translateZ(0) rotateX(0deg); }
        }

        .navbar {
            animation: float 3s infinite ease-in-out;
        }

        /* Added CSS to initially hide both buttons */
        #registerButton, #viewDetailsButton, #editDetailsButton {
            display: none;
        }
    </style>
</head>
<body>
    
    <div class="navbar-container" onclick="toggleNavbar()">
        <div class="navbar">
            <span class="title">Dashboard</span>
            <span class="toggle-icon"><i class="fas fa-bars"></i></span>
        </div>
    </div>
    <div class="sidebar">
        <h4>Student Panel</h4>
        <a href="{{ route('register.form') }}" id="registerButton">
            <i class="fas fa-user-plus"></i> Registration
        </a>
        <a href="{{ route('student.details') }}" id="viewDetailsButton">
            <i class="fas fa-info-circle"></i> View Details
        </a>
        <a href="{{  route('students.edit', $student->id) }}" id="editDetailsButton">
            <i class="fas fa-info-circle"></i> Edit Details
        </a>
        <!-- <a href="{{ route('students.edit', $student->id) }}" id="viewDetailsButton">
        <i class="btn btn-warning btn-sm"></i>Edit</a> -->
        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
    <div class="content">
        <!-- Content can be added here -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
    <script>

document.addEventListener("DOMContentLoaded", function () {
    // Check if there's a success message in the session
    @if(session('success_message'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success_message') }}",
            timer: 1000, // 3 seconds
            showConfirmButton: false
        });
    @endif
    });


document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });
        function toggleNavbar() {
            const navbar = document.querySelector('.navbar');
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            const toggleIcon = document.querySelector('.toggle-icon i');

            navbar.classList.toggle('collapsed');
            sidebar.classList.toggle('expanded');
            content.classList.toggle('expanded');

            if (sidebar.classList.contains('expanded')) {
                toggleIcon.classList.remove('fa-bars');
                toggleIcon.classList.add('fa-times');
            } else {
                toggleIcon.classList.remove('fa-times');
                toggleIcon.classList.add('fa-bars');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            fetch("{{ route('check.registration') }}")
                .then(response => response.json())
                .then(data => {
                    const registerButton = document.getElementById("registerButton");
                    const viewDetailsButton = document.getElementById("viewDetailsButton");
                    const editDetailsButton = document.getElementById("editDetailsButton");

                    if (data.registered) {
                        viewDetailsButton.style.display = 'flex';
                        editDetailsButton.style.display = 'flex';
                    }
                    else {
                        registerButton.style.display = 'flex';
                    }
                })
                .catch(error => console.error("Error checking registration:", error));
        });
    </script>
</body>
</html>