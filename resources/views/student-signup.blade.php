<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Signup</title>
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

        .signup-wrapper {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: var(--shadow-strong);
            padding: 40px;
            width: 100%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: cardEntry 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .signup-container:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.25);
        }

        @keyframes cardEntry {
            from {
                opacity: 0;
                transform: translateY(50px) rotateX(-30deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        .signup-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 12px;
            text-align: center;
            background: linear-gradient(45deg, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .signup-subtitle {
            color: var(--text-secondary);
            text-align: center;
            margin-bottom: 30px;
            font-size: 1rem;
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

        .input-wrapper {
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

        .password-toggle {
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

        .password-toggle:hover {
            color: #667eea;
            background: rgba сталайл(102, 126, 234, 0.1);
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

        .btn-success {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #48bb78, #38a169);
            border: none;
            border-radius: 12px;
            color: var(--text-light);
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 10px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-soft);
            position: relative;
            overflow: hidden;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(72, 187, 120, 0.4);
        }

        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-success:hover::before {
            left: 100%;
        }

        .btn-link {
            color: #667eea;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            text-align: center;
        }

        .btn-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .step-transition {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
        }

        #otp-verification {
            display: none;
            opacity: 0;
            transform: translateY(20px);
        }

        #otp-verification.active {
            opacity: 1;
            transform: translateY(0);
        }

        .loading {
            position: relative;
            color: transparent !important;
        }

        .loading::after {
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

        /* Responsive Design */
        @media (max-width: 576px) {
            .signup-wrapper {
                padding: 10px;
            }

            .signup-container {
                padding: 30px 20px;
            }

            .signup-title {
                font-size: 1.8rem;
            }

            .form-control {
                padding: 14px 18px 14px 45px;
            }

            .input-icon {
                left: 15px;
            }

            .password-toggle {
                right: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="geometric-bg">
        <div class="geometric-shape shape-1"></div>
        <div class="geometric-shape shape-2"></div>
        <div class="geometric-shape shape-3"></div>
    </div>

    <div class="signup-wrapper">
        <div class="signup-container">
            <h2 class="signup-title">Student Signup</h2>
            <p class="signup-subtitle">Create your account to start your learning journey</p>

            <!-- Signup Form -->
            <div id="signup-form" class="step-transition">
                <form id="signupForm" onsubmit="sendOTP(event)">
                    <div class="form-group">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email address" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                            <button class="password-toggle" type="button" onclick="togglePassword('password')">
                                <i class="fas fa-eye-slash" id="password-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                            <button class="password-toggle" type="button" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye-slash" id="password_confirmation-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary" id="signupButton">Send OTP →</button>
                </form>
            </div>

            <!-- OTP Verification -->
            <div id="otp-verification" class="step-transition">
                <p class="signup-subtitle">We've sent an OTP to your email</p>
                <form id="otpForm" onsubmit="verifyOTP(event)">
                    <div class="form-group">
                        <label for="otp" class="form-label">6-digit OTP</label>
                        <div class="input-wrapper">
                            <i class="fas fa-key input-icon"></i>
                            <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP" maxlength="6" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-success" id="verifyButton">Verify OTP ✓</button>
                    <button type="button" onclick="toggleSteps()" class="btn-link">← Back to Signup</button>
                </form>
            </div>
        </div>
    </div>

    <input type="hidden" id="verifyOtpRoute" value="{{ route('student.verify.otp') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`${fieldId}-eye`);
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }

        function animateStepTransition(hideElement, showElement) {
            hideElement.style.opacity = '0';
            hideElement.style.transform = 'translateY(-20px)';
            showElement.classList.add('active');
            showElement.style.display = 'block';
            setTimeout(() => {
                hideElement.style.display = 'none';
            }, 300);
        }

        async function sendOTP(event) {
            event.preventDefault();
            const btn = document.getElementById('signupButton');
            btn.classList.add('loading');
            btn.disabled = true;

            const data = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            };

            // Client-side validation
            if (!data.name.trim()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Please enter your full name',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea'
                });
                btn.classList.remove('loading');
                btn.disabled = false;
                return;
            }

            if (!data.email.includes('@')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Email',
                    text: 'Please enter a valid email address',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea'
                });
                btn.classList.remove('loading');
                btn.disabled = false;
                return;
            }

            if (data.password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Weak Password',
                    text: 'Password must be at least 8 characters long',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea'
                });
                btn.classList.remove('loading');
                btn.disabled = false;
                return;
            }

            if (data.password !== data.password_confirmation) {
                Swal.fire({
                    icon: 'error',
                    title: 'Password Mismatch',
                    text: 'Passwords do not match',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea'
                });
                btn.classList.remove('loading');
                btn.disabled = false;
                return;
            }

            try {
                const response = await fetch("/student/initiate-signup", {
                    method: "POST",
                    headers: { 
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();
                
                if (!response.ok) throw result;
                animateStepTransition(document.getElementById('signup-form'), document.getElementById('otp-verification'));
                Swal.fire({
                    icon: 'success',
                    title: 'OTP Sent!',
                    text: result.message || 'Check your email for the OTP',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea',
                    customClass: {
                        popup: 'modern-popup'
                    }
                });
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.error || 'Something went wrong!',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea',
                    customClass: {
                        popup: 'modern-popup'
                    }
                });
            } finally {
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        }

        async function verifyOTP(event) {
            event.preventDefault();
            const btn = document.getElementById('verifyButton');
            btn.classList.add('loading');
            btn.disabled = true;

            const otp = document.getElementById('otp').value;
            const verifyOtpUrl = document.getElementById('verifyOtpRoute').value;

            if (!/^\d{6}$/.test(otp)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid OTP',
                    text: 'Please enter a valid 6-digit OTP',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea'
                });
                btn.classList.remove('loading');
                btn.disabled = false;
                return;
            }

            try {
                const response = await fetch(verifyOtpUrl, {
                    method: "POST",
                    headers: { 
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({ otp })
                });
                const result = await response.json();
                
                if (!response.ok) throw result;
                Swal.fire({
                    icon: 'success',
                    title: 'Verified!',
                    text: result.message || 'Account created successfully',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea',
                    customClass: {
                        popup: 'modern-popup'
                    }
                }).then(() => {
                    window.location.href = result.redirect || '/dashboard';
                });
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid OTP',
                    text: error.error || 'Please check the code and try again',
                    background: '#ffffff',
                    color: '#2d3748',
                    confirmButtonColor: '#667eea',
                    customClass: {
                        popup: 'modern-popup'
                    }
                });
            } finally {
                btn.classList.remove('loading');
                btn.disabled = false;
            }
        }

        function toggleSteps() {
            animateStepTransition(document.getElementById('otp-verification'), document.getElementById('signup-form'));
        }

        // Add input focus animations and custom SweetAlert styles
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