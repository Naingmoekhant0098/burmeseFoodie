<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code - Foodie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background: #fff;
            max-width: 480px;
            margin: 40px auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 32px 24px;
        }
        .header {
            text-align: center;
            margin-bottom: 24px;
        }
        .otp-code {
            display: inline-block;
            background: #f0f4ff;
            color: #2d5be3;
            font-size: 2em;
            letter-spacing: 6px;
            padding: 12px 32px;
            border-radius: 6px;
            margin: 16px 0;
            font-weight: bold;
        }
        .footer {
            margin-top: 32px;
            color: #888;
            font-size: 0.95em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            {{-- <img src="https://i.imgur.com/8Km9tLL.png" alt="Foodie Logo" width="64" style="margin-bottom: 12px;"> --}}
            <h2>Burmese Foodie OTP Verification👋🏻</h2>
        </div>
        <p>Hello,User</p>
        <p>Use the following OTP code to verify your account:</p>
       <div style=" text-align: center;">
        <div class="otp-code">{{ $otp }}</div>
       </div>
        <p>If you did not request this code, please ignore this email.</p>
        <div class="footer">
            Thank you,<br>
            Burmese Foodie Team
        </div>
    </div>
</body>
</html>