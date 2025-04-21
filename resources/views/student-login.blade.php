<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login Portal</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --accent-color: #f72585;
            --dark-bg: #1a1a2e;
            --light-bg: #f8f9fa;
            --text-dark: #16213e;
            --text-light: #e2e2e2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--dark-bg), #16213e);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            perspective: 1000px;
        }

        .alert-container {
            width: 100%;
            max-width: 800px;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
        }

        .login-container {
            position: relative;
            width: 900px;
            height: 550px;
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform-style: preserve-3d;
            animation: float 6s ease-in-out infinite;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .login-container:hover {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 35px 60px rgba(0, 0, 0, 0.6);
        }

        .left-panel {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            background: linear-gradient(135deg, rgb(0 0 0 / 80%), rgba(58, 12, 163, 0.9));
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            z-index: -1;
        }

        .right-panel {
            width: 50%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: var(--light-bg);
            position: relative;
        }

        .user-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(67, 97, 238, 0.5);
            transform: translateZ(50px);
            transition: all 0.3s ease;
        }

        .user-icon:hover {
            transform: translateZ(50px) scale(1.1);
            box-shadow: 0 15px 40px rgba(67, 97, 238, 0.7);
        }

        h2 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
        }

        .left-panel h2 {
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .right-panel h2 {
            color: var(--primary-color);
            margin-bottom: 30px;
        }

        .right-panel h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }

        .left-panel p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            text-align: center;
            line-height: 1.6;
        }

        .form-group {
            width: 100%;
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 5px 20px rgba(67, 97, 238, 0.2);
            outline: none;
            transform: translateY(-2px);
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .btn-eye {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #777;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .btn-eye:hover {
            color: var(--primary-color);
            transform: translateY(-50%) scale(1.1);
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 1px;
            color: white;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(67, 97, 238, 0.4);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-block;
            position: relative;
        }

        a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        a:hover {
            color: var(--secondary-color);
        }

        a:hover::after {
            width: 100%;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatElement linear infinite;
        }

        @keyframes floatElement {
            0% { transform: translateY(0) rotate(0deg); opacity: 1; }
            100% { transform: translateY(-1000px) rotate(720deg); opacity: 0; }
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-container {
                width: 90%;
                height: auto;
                flex-direction: column;
            }

            .left-panel, .right-panel {
                width: 100%;
                padding: 30px;
            }

            .left-panel {
                padding-bottom: 50px;
            }

            .right-panel {
                border-radius: 0 0 20px 20px;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                width: 95%;
            }

            .left-panel, .right-panel {
                padding: 25px;
            }

            h2 {
                font-size: 1.8rem;
            }

            .user-icon {
                width: 80px;
                height: 80px;
                font-size: 30px;
            }
        }
    </style>
</head>
<body>
<div class="floating-elements" id="floatingElements"></div>
<div class="login-container">
    <div class="left-panel">
        <div class="user-icon">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <h2>Welcome Back!</h2>
        <p>Enter your credentials to access your student portal and continue your learning journey.</p>
        <div style="width: 80%; height: 2px; background: rgba(255,255,255,0.2); margin: 20px 0;"></div>
        <p>New to our platform?
        <p class="text-center mt-3">
    Don’t have an account? 
    <a href="{{ route('student.signup') }}" class="text-primary">Sign up here</a>

</p>


    </p>
    </div>
    <div class="right-panel">
        <h2>Student Login</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username" class="form-label">Email ID</label>
                <div class="input-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter your email" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                    <button class="btn-eye" type="button" onclick="togglePassword()">
                        <i class="fa-solid fa-eye-slash" id="eye-icon"></i>
                    </button>
                </div>
                <div class="text-end mt-2">
                    <a href="{{ route('forgot-password') }}">Forgot Password?</a>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">LOGIN</button>
        </form>
    </div>
</div>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script>
    // Create floating elements
    function createFloatingElements() {
        const container = document.getElementById('floatingElements');
        const count = 15;
        
        for (let i = 0; i < count; i++) {
            const element = document.createElement('div');
            element.classList.add('floating-element');
            
            // Random size between 5px and 15px
            const size = Math.random() * 10 + 5;
            element.style.width = `${size}px`;
            element.style.height = `${size}px`;
            
            // Random position
            element.style.left = `${Math.random() * 100}%`;
            element.style.top = `${Math.random() * 100}%`;
            
            // Random animation duration between 10s and 30s
            const duration = Math.random() * 20 + 10;
            element.style.animationDuration = `${duration}s`;
            
            // Random delay
            element.style.animationDelay = `${Math.random() * 5}s`;
            
            // Random opacity
            element.style.opacity = Math.random() * 0.5 + 0.1;
            
            container.appendChild(element);
        }
    }

    // Toggle password visibility
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    }

    // Show alerts for error/success messages
    window.onload = function() {
        createFloatingElements();
        let body = document.body;
        
        @if (session('error'))
            body.style.overflow = "hidden";
            Swal.fire({
                title: 'Error',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK',
                background: 'rgba(26, 26, 46, 0.9)',
                color: '#ffffff',
                confirmButtonColor: '#4361ee'
            }).then(() => {
                body.style.overflow = "";
            });
        @endif

        @if (session('success'))
            body.style.overflow = "hidden";
            Swal.fire({
                title: 'Success',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                background: 'rgba(26, 26, 46, 0.9)',
                color: '#ffffff',
                confirmButtonColor: '#4361ee'
            }).then(() => {
                body.style.overflow = "";
            });
        @endif
    };
</script>
</body>
</html>