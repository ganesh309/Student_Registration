
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <style>
        /* Enhanced Keyframes */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Background Particles */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 4s ease-in-out infinite;
        }

        .reset-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            animation: fadeInUp 0.8s ease-out;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
            position: relative;
            overflow: hidden;
        }

        .reset-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
            animation: pulse 6s infinite;
            pointer-events: none;
        }

        .reset-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        .student-image {
            border: 4px solid #fff;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            transition: all 0.4s ease;
            animation: float 3s ease-in-out infinite;
        }

        .student-image:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .reset-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-size: 200% 200%;
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .reset-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.2);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
            z-index: -1;
        }

        .reset-btn:hover::before {
            transform: scaleX(1);
        }

        .reset-btn:hover {
            letter-spacing: 2.5px;
            transform: translateY(-3px);
            animation: gradientFlow 3s ease infinite;
        }

        .success-message {
            animation: fadeInUp 0.5s ease-out;
            border-left: 4px solid #48bb78;
            transform: translateZ(0);
        }

        .loading {
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: #fff;
            animation: loading 0.8s linear infinite;
        }

        .form-title {
            position: relative;
            padding-bottom: 15px;
        }

        .form-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 2px;
        }
    </style>
</head>
<body>
<!-- Background Particles -->
<div class="particles" id="particles"></div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="reset-card p-5">
                <h2 class="text-center mb-4 form-title" style="color: #2d3748;">Verify Your OTP</h2>
                
                @if(session('success'))
                    <div class="alert alert-success success-message mb-4 p-3">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/students/images/' . $imageName) }}" 
                         alt="Student Image"
                         class="student-image img-fluid rounded-circle" 
                         width="130">
                    <h4 class="mt-3" style="color: #4a5568; transition: color 0.3s ease;"
                        onmouseover="this.style.color='#667eea'"
                        onmouseout="this.style.color='#4a5568'">
                        {{ $student->name }}
                    </h4>
                </div>

            
                <form method="POST" action="{{ route('forgot-password.verify-otp') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $student->email }}">

                    <div class="form-group mb-3">
                        <label for="otp">Enter OTP</label>
                        <input type="number" name="otp" class="form-control" placeholder="Enter the OTP" required>
                        @error('otp')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                </form>
                <div class="text-center mt-4" style="color: #718096;">
                    <span class="d-block mb-2">Remember your password?</span>
                    <a href="{{ route('login') }}" 
                       class="text-decoration-none" 
                       style="color: #667eea; transition: all 0.3s ease;"
                       onmouseover="this.style.color='#764ba2'; this.style.textDecoration='underline'"
                       onmouseout="this.style.color='#667eea'; this.style.textDecoration='none'">
                       Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
 @if(session('error'))
        showOtpError("{{ session('error') }}");
    @endif

    function showOtpError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: message,
        confirmButtonColor: '#667eea',
    });
}

    // Form submission handling
    document.getElementById('resetForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('submitBtn');
        const loader = document.getElementById('loader');
        const btnText = document.getElementById('btnText');
        
        btn.disabled = true;
        btn.style.cursor = 'not-allowed';
        btnText.classList.add('d-none');
        loader.classList.remove('d-none');
    });

    // Particle Animation
    const particleContainer = document.getElementById('particles');
    function createParticle() {
        const particle = document.createElement('div');
        particle.className = 'particle';
        const size = Math.random() * 10 + 5;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.top = `${Math.random() * 100}%`;
        particle.style.animationDuration = `${Math.random() * 3 + 2}s`;
        particleContainer.appendChild(particle);
        
        setTimeout(() => particle.remove(), 5000);
    }
    setInterval(createParticle, 300);
    const resetBtn = document.getElementById('submitBtn');
    resetBtn.addEventListener('mouseover', () => {
    });
</script>
</body>
</html>


