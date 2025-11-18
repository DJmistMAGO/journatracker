<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: linear-gradient(135deg, #fef08a 0%, #84cc16 100%);
            padding: 40px 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        .header {
            background: linear-gradient(135deg, #fbbf24 0%, #22c55e 100%);
            color: white;
            padding: 50px 30px;
            text-align: center;
            position: relative;
        }
        .header::before {
            content: '🔐';
            font-size: 60px;
            display: block;
            margin-bottom: 15px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .message {
            color: #4b5563;
            margin-bottom: 25px;
            font-size: 15px;
        }
        .password-box {
            background: linear-gradient(135deg, #fef3c7 0%, #d9f99d 100%);
            border: 3px solid #facc15;
            padding: 25px;
            margin: 30px 0;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(251, 191, 36, 0.2);
            position: relative;
            overflow: hidden;
        }
        .password-box::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shine 3s infinite;
        }
        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        .password-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #65a30d;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .password-value {
            font-size: 28px;
            font-weight: 800;
            color: #166534;
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
            position: relative;
            z-index: 1;
        }
        .warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fef08a 100%);
            border-left: 5px solid #eab308;
            padding: 20px;
            margin: 30px 0;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(234, 179, 8, 0.15);
        }
        .warning-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: #854d0e;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .warning-icon {
            font-size: 24px;
        }
        .warning p {
            color: #92400e;
            margin: 0;
            font-size: 14px;
        }
        .instructions-title {
            font-weight: 700;
            color: #1f2937;
            margin: 25px 0 15px 0;
            font-size: 16px;
        }
        .instructions {
            background: #f9fafb;
            border-radius: 10px;
            padding: 20px 20px 20px 45px;
            margin: 15px 0;
        }
        .instructions li {
            color: #4b5563;
            margin-bottom: 12px;
            font-size: 14px;
            line-height: 1.8;
        }
        .instructions li:last-child {
            margin-bottom: 0;
        }
        .email-highlight {
            color: #16a34a;
            font-weight: 700;
            background: linear-gradient(135deg, #fef3c7 0%, #d9f99d 100%);
            padding: 2px 8px;
            border-radius: 5px;
        }
        .signature {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px solid #f3f4f6;
            color: #6b7280;
            font-size: 15px;
        }
        .app-name {
            background: linear-gradient(135deg, #fbbf24 0%, #22c55e 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }
        .footer {
            background: linear-gradient(135deg, #fef9e7 0%, #f0fdf4 100%);
            text-align: center;
            padding: 25px 30px;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Password Reset</h1>
        </div>
        <div class="content">
            <div class="greeting">Hello {{ $user->name }},</div>

            <p class="message">Your password has been reset by an administrator. Your new temporary password is:</p>

            <div class="password-box">
                <div class="password-label">Temporary Password</div>
                <div class="password-value">{{ $defaultPassword }}</div>
            </div>

            <div class="warning">
                <div class="warning-title">
                    <span class="warning-icon">⚠️</span>
                    Important Security Notice
                </div>
                <p>Please change this password immediately after logging in to ensure your account security.</p>
            </div>

            <div class="instructions-title">To log in:</div>
            <ol class="instructions">
                <li>Go to the login page</li>
                <li>Use your email: <span class="email-highlight">{{ $user->email }}</span></li>
                <li>Enter the temporary password above</li>
                <li>Change your password in your account settings</li>
            </ol>

            <p class="message">If you did not request a password reset, please contact support immediately.</p>

            <div class="signature">
                Best regards,<br>
                <span class="app-name">{{ config('app.name') }}</span> Team
            </div>
        </div>
        <div class="footer">
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
