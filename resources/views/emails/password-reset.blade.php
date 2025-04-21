<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        h2 {
            color: #764ba2;
            margin: 20px 0;
            font-size: 28px;
        }
        p {
            line-height: 1.6;
            margin: 15px 0;
        }
        .button {
            background: linear-gradient(45deg, #764ba2, #667eea);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
            transition: transform 0.2s;
        }
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .footer {
            font-size: 12px;
            color: #666;
            margin-top: 20px;
            text-align: center;
        }
        .header {
            color: #764ba2;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Password Reset</div>
        <p>Hi {{ $student->name }},</p>
        <p>You requested a password reset. Here’s your OTP:</p>
        <h2>{{ $otp }}</h2>
        <p>Alternatively, you can reset your password using the link below:</p>
        <a href="{{ $otpUrl }}" class="button" style="white">Reset Password</a>
        <p>If you did not request this, please ignore this email.</p>
        <div class="footer">This is an automated message. Please do not reply directly to this email.</div>
    </div>
</body>
</html>