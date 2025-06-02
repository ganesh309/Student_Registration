<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.all.min.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --accent-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-surface: #1a1b23;
            --light-surface: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --text-light: #ffffff;
            --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.12);
            --shadow-strong: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(-45deg, #1a1b23, #2d3748, #4a5568, #2b6cb0);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .geometric-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.1;
        }

        .geometric-shape {
            position: absolute;
            background: var(--accent-gradient);
            animation: float 8s ease-in-out infinite;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            border-radius: 30px;
            top: 60%;
            right: 15%;
            animation-delay: -2s;
            transform: rotate(45deg);
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            bottom: 20%;
            left: 20%;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .login-wrapper {
            width: 100%;
            max-width: 1100px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: var(--shadow-strong);
            overflow: hidden;
            width: 100%;
            max-width: 950px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-container:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);
        }

        .left-panel {
            background: var(--primary-gradient);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--text-light);
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            animation: patternMove 20s linear infinite;
        }

        @keyframes patternMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(60px, 60px); }
        }

        .user-icon {
            width: 120px;
            height: 120px;
            background: var(--light-surface);
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: transparent;
            background: var(--secondary-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            margin-bottom: 30px;
            box-shadow: var(--shadow-soft);
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .user-icon:hover {
            transform: scale(1.05) rotate(5deg);
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 16px;
            background: linear-gradient(45deg, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            position: relative;
            z-index: 2;
        }

        .left-panel p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 40px;
            position: relative;
            z-index: 2;
        }

        .right-panel {
            background: var(--light-surface);
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            text-align: center;
            background: none;
            -webkit-background-clip: initial;
            background-clip: initial;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 16px 20px 16px 50px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            background: #f8fafc;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            background: var(--light-surface);
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1.1rem;
            z-index: 1;
        }

        .btn-eye {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-eye:hover {
            color: #667eea;
            background: rgba(102, 126, 234, 0.1);
        }

        .btn-primary {
            width: 100%;
            padding: 16px;
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            color: var(--text-light);
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-soft);
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
            transition: left 0.5s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        a {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .signup-link {
            padding: 12px 32px;
            background: var(--light-surface);
            color: var(--text-primary);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-soft);
            position: relative;
            z-index: 2;
            display: inline-block;
        }

        .signup-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(255, 255, 255, 0.2);
            color: var(--text-primary);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-container {
                grid-template-columns: 1fr;
                margin: 20px;
                border-radius: 20px;
            }

            .left-panel {
                padding: 40px 30px;
                order: 2;
            }

            .right-panel {
                padding: 40px 30px;
                order: 1;
            }

            h2 {
                font-size: 2rem;
            }

            .user-icon {
                width: 100px;
                height: 100px;
                font-size: 40px;
            }
        }

        @media (max-width: 576px) {
            .login-wrapper {
                padding: 10px;
            }

            .left-panel,
            .right-panel {
                padding: 30px 20px;
            }

            .form-control {
                padding: 14px 18px 14px 45px;
            }

            .input-icon {
                left: 15px;
            }

            .btn-eye {
                right: 15px;
            }
        }

        /* Loading animation for form submission */
        .btn-loading {
            position: relative;
            color: transparent !important;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="geometric-bg">
        <div class="geometric-shape shape-1"></div>
        <div class="geometric-shape shape-2"></div>
        <div class="geometric-shape shape-3"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-container">
            <div class="left-panel">
                <div class="user-icon">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <h2>Welcome Back!</h2>
                <p>Enter your credentials to access your student portal and continue your learning journey.</p>
                <div style="width: 80%; height: 2px; background: rgba(255,255,255,0.2); margin: 20px 0;"></div>
                <p>Don’t have an account? 
                    <a href="{{ route('student.signup') }}" class="signup-link">Sign up here</a>
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

                    <button type="submit" class="btn-primary" id="loginButton">LOGIN</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
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

        // Handle form submission
        function handleLogin(event) {
            event.preventDefault();
            
            const loginButton = document.getElementById('loginButton');
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Add loading state
            loginButton.classList.add('btn-loading');
            loginButton.disabled = true;
            
            // Simulate login process
            setTimeout(() => {
                loginButton.classList.remove('btn-loading');
                loginButton.disabled = false;
                
                // Show success message
                Swal.fire({
                    title: 'Login Successful!',
                    text: 'Welcome back to your student portal.',
                    icon: 'success',
                    confirmButtonText: 'Continue',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea',
                    customClass: {
                        popup: 'modern-popup'
                    }
                });
            }, 2000);
        }

        // Add input focus animations
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Add custom styles for SweetAlert
            const style = document.createElement('style');
            style.textContent = `
                .modern-popup {
                    border-radius: 16px !important;
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2) !important;
                }
                .swal2-confirm {
                    border-radius: 8px !important;
                    padding: 10px 24px !important;
                    font-weight: 600 !important;
                }
            `;
            document.head.appendChild(style);
        });

        // Add parallax effect to geometric shapes
        document.addEventListener('mousemove', function(e) {
            const shapes = document.querySelectorAll('.geometric-shape');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.5;
                const xMove = (x - 0.5) * speed * 20;
                const yMove = (y - 0.5) * speed * 20;
                
                shape.style.transform = `translate(${xMove}px, ${yMove}px)`;
            });
        });
    </script>
</body>
</html>