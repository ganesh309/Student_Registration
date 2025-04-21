<!DOCTYPE html>
<html>
<head>
    <title>Profile Update Notification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #667eea;
        }

        p {
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            color: #fff;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $student->name }}!</h1>
        <p>Your profile has been successfully updated.</p>
        <p>If you didn’t make this change, please contact support immediately.</p>
        <a href="{{ route('login') }}" class="btn">Go to Dashboard</a>
        <p style="margin-top: 20px; font-size: 0.9em; color: #666;">
            Regards,<br>
            The Team
        </p>
    </div>
</body>
</html>
