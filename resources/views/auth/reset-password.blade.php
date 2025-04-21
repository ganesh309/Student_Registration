<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.6s ease-out;
            width: 100%;
            max-width: 450px;
            padding: 2.5rem;
            transition: transform 0.3s ease;
        }

        .password-card:hover {
            transform: translateY(-5px);
        }

        .form-title {
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 1.8rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 20px 12px 45px;
            height: 50px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: none;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 1.2rem;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #a0aec0;
            font-size: 1.2rem;
        }

        .btn-reset {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .alert {
            border-radius: 10px;
        }

        @media (max-width: 576px) {
            .password-card {
                margin: 20px;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    
    <div class="password-card">
        <h2 class="form-title">
            <i class="fas fa-lock me-2"></i>Reset Your Password
        </h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $student->email }}">
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" class="form-control" 
                       placeholder="New Password" required autofocus id="password">
                <i class="fas fa-eye-slash toggle-password" data-target="password"></i>
                @error('password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <i class="fas fa-check-circle input-icon"></i>
                <input type="password" name="password_confirmation" class="form-control" 
                       placeholder="Confirm New Password" required id="password_confirmation">
                <i class="fas fa-eye-slash toggle-password" data-target="password_confirmation"></i>
            </div>

            <button type="submit" class="btn btn-reset">
                <i class="fas fa-sync-alt me-2"></i>Reset Password
            </button>
        </form>
    </div>

    <script>
    $(document).ready(function() {
        // Toggle Password Visibility
        $(".toggle-password").click(function() {
            let input = $("#" + $(this).attr("data-target"));
            let icon = $(this);
            
            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
        });

        // SweetAlert for OTP success
        @if(session('otp_success'))
            Swal.fire({
                icon: 'success',
                title: 'OTP Verified Successfully!',
                text: 'Now reset your password.',
                confirmButtonColor: '#667eea',
            });
        @endif
    });
</script>

</body>
</html>
