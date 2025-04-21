
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <style>
       @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        body {
            background-color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .container {
            width: 80%; 
            max-width: 1500px; 
            height: 700px; 
            margin: 20px auto;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            display: flex; 
            gap: 300px;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            perspective: 1000px; /* Add perspective for 3D effect */
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            transform-style: preserve-3d; /* Enable 3D transformations */
            transform: rotateX(60deg) translateZ(-100px) scale(0.9); /* Initial laid-down state */
            opacity: 0.7;
            filter: blur(2px);
            transition: all 1.2s cubic-bezier(0.34, 1.56, 0.64, 1);
            cursor: pointer;
        }

        .auth-card.active {
            transform: rotateX(0) translateZ(0) scale(1); /* Upright state */
            opacity: 1;
            filter: blur(0);
            cursor: default;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 0;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-position: 100% 0;
        }
        .toggle-button {
            cursor: pointer;
            color: #667eea;
            font-weight: 600;
            text-decoration: underline;
        }

        .alert {
            animation: shake 0.4s ease;
        }

        .password-icon {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 1.5rem;
        }

        img {
            max-width: 350px;
            /* border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2); */
        }
    </style>
</head>
<body>
<div class="container">
        <img src="{{ asset('images/forgot.png') }}" alt="Overlay Image">
        <div class="auth-card">
            <div class="text-center mb-4">
                <i class="fas fa-lock password-icon"></i>
                <h2 class="font-weight-bold mb-3">Forgot Password?</h2>
                <p class="text-muted">Enter your email or registration number to reset your password</p>
            </div>
            <form action="{{ route('forgot-password.check') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-4">
                    <label for="identifier" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="identifier" class="form-control" id="identifier" 
                            placeholder="name@example.com" required>
                    </div>
                </div>
                <p class="text-center toggle-button" id="toggleMethod">Search by Registration No</p>
                <button type="submit" class="btn btn-primary w-100">
                    Continue <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-decoration-none">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Login
                </a>
            </div>
        </div>
    </div>

    <script>
          const toggleBtn = document.getElementById('toggleMethod');
        const identifierInput = document.getElementById('identifier');
        const identifierLabel = document.querySelector('label[for="identifier"]');

        toggleBtn.addEventListener('click', () => {
            if (identifierInput.type === 'email') {
                identifierInput.type = 'text';
                identifierInput.placeholder = 'Enter Registration Number';
                identifierLabel.textContent = 'Registration Number';
                toggleBtn.textContent = 'Search by Email';
            } else {
                identifierInput.type = 'email';
                identifierInput.placeholder = 'name@example.com';
                identifierLabel.textContent = 'Email Address';
                toggleBtn.textContent = 'Search by Registration No';
            }
        });
        // Add click event listener to trigger animation
        document.addEventListener('DOMContentLoaded', function() {
            const authCard = document.querySelector('.auth-card');
            
            authCard.addEventListener('click', function() {
                if (!this.classList.contains('active')) {
                    this.classList.add('active');
                }
            }, { once: true }); // Only trigger once

            // Add animation for form elements when active
            authCard.addEventListener('transitionend', function() {
                if (this.classList.contains('active')) {
                    this.querySelectorAll('input, button').forEach(el => {
                        el.style.animation = 'fadeIn 0.5s ease forwards';
                    });
                }
            });

            // ... (keep existing validation and SweetAlert code) ...
        });
        window.onload = function() {
                @if (session('error'))
                    Swal.fire({
                        title: 'Error',
                        text: "{{ session('error') }}",
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                @endif
                }

            (function () {
                'use strict'
                const forms = document.querySelectorAll('.needs-validation')
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                            form.classList.add('was-validated')
                        }
                    }, false)
                })
            })()
    </script>
</body>
</html>
