<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            perspective: 1000px;
        }

        .container {
            transform-style: preserve-3d;
            animation: cardEntry 1s cubic-bezier(0.4, 0, 0.2, 1);
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

        .card {
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transform-style: preserve-3d;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px) rotateX(3deg) rotateY(2deg);
        }

        h3 {
            color: #2d3748;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 15px rgba(102, 126, 234, 0.2);
            transform: scale(1.02);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 12px;
            border-radius: 10px;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
            border: none;
        }

        .step-transition {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
        }

        #otp-verification {
            opacity: 0;
            transform: translateY(20px);
        }

        #otp-verification.active {
            opacity: 1;
            transform: translateY(0);
        }

        .floating-label {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .floating-label input {
            z-index: 1;
        }

        .floating-label label {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #718096;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 5px;
        }

        .floating-label input:focus + label,
        .floating-label input:not(:placeholder-shown) + label {
            top: 0;
            font-size: 0.8em;
            color: #667eea;
        }

        .loading {
            position: relative;
            pointer-events: none;
        }

        .loading::after {
            content: "";
            position: absolute;
            right: 15px;
            top: 50%;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            transform: translateY(-50%);
        }

        @keyframes spin {
            to { transform: translateY(-50%) rotate(360deg); }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card p-4" style="max-width: 500px; width: 100%;">
        <h3 class="text-center mb-4">🎓 Student Signup</h3>

        <!-- Signup Form -->
        <div id="signup-form" class="step-transition">
            <div class="floating-label">
                <input type="text" id="name" class="form-control mb-3" placeholder=" " required>
                <label>Full Name</label>
            </div>
            <div class="floating-label">
                <input type="email" id="email" class="form-control mb-3" placeholder=" " required>
                <label>Email Address</label>
            </div>
            <div class="floating-label">
                <input type="password" id="password" class="form-control mb-3" placeholder=" " required>
                <label>Password</label>
            </div>
            <div class="floating-label">
                <input type="password" id="password_confirmation" class="form-control mb-4" placeholder=" " required>
                <label>Confirm Password</label>
            </div>
            <button onclick="sendOTP()" class="btn btn-primary w-100">Send OTP →</button>
        </div>

        <!-- OTP Verification -->
        <div id="otp-verification" class="step-transition">
            <p class="text-muted text-center mb-3">📨 We've sent an OTP to your email</p>
            <div class="floating-label">
                <input type="text" id="otp" class="form-control mb-3" placeholder=" " maxlength="6">
                <label>6-digit OTP</label>
            </div>
            <button onclick="verifyOTP()" class="btn btn-success w-100 mb-3">Verify OTP ✓</button>
            <button onclick="toggleSteps()" class="btn btn-link w-100 text-decoration-none">← Back to Signup</button>
        </div>
    </div>
</div>

<input type="hidden" id="verifyOtpRoute" value="{{ route('student.verify.otp') }}">

<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

function animateStepTransition(hideElement, showElement) {
    hideElement.style.opacity = '0';
    hideElement.style.transform = 'translateY(-20px)';
    showElement.classList.add('active');
    showElement.style.display = 'block';
    setTimeout(() => {
        hideElement.style.display = 'none';
    }, 300);
}

async function sendOTP() {
    const btn = event.target;
    btn.classList.add('loading');
    
    const data = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        password_confirmation: document.getElementById('password_confirmation').value
    };

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
        
        if (result.error) throw result;
        animateStepTransition(document.getElementById('signup-form'), document.getElementById('otp-verification'));
        Swal.fire({
            icon: 'success',
            title: 'OTP Sent!',
            text: result.message,
            customClass: {
                popup: 'animated tada'
            }
        });
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error.error || 'Something went wrong!',
            showClass: {
                popup: 'animated shakeX'
            }
        });
    } finally {
        btn.classList.remove('loading');
    }
}

async function verifyOTP() {
    const btn = event.target;
    btn.classList.add('loading');
    
    const otp = document.getElementById('otp').value;
    const verifyOtpUrl = document.getElementById('verifyOtpRoute').value;

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
        
        if (result.error) throw result;
        Swal.fire({
            icon: 'success',
            title: 'Verified!',
            text: result.message,
            showClass: {
                popup: 'animated heartBeat'
            }
        }).then(() => {
            window.location.href = result.redirect;
        });
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid OTP',
            text: error.error || 'Please check the code and try again',
            showClass: {
                popup: 'animated headShake'
            }
        });
    } finally {
        btn.classList.remove('loading');
    }
}

function toggleSteps() {
    animateStepTransition(document.getElementById('otp-verification'), document.getElementById('signup-form'));
}
</script>
</body>
</html>