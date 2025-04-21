<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/adminLogin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="login-container">
        <div class="card">
            <!-- Admin Logo -->
            <div class="admin-logo">
                <i class="fa-solid fa-user-shield"></i>
            </div>

            <h3 class="text-center mb-4 text-white">Admin Login</h3>

            <!-- Admin Login Form -->
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label text-white">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required placeholder="Enter username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" required placeholder="Enter password">
                        <button class="toggle-password" type="button">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('popper.min.js') }}"></script>
    <script src="{{ asset('alert.js') }}"></script>
    <script>
        window.onload = function() {
            @if (session('error'))
                Swal.fire({
                    title: 'Error',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            @endif
        };

        document.querySelector('.toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        });
    </script>

</body>
</html>
