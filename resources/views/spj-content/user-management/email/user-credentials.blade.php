<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Status Update</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #fbbf24 0%, #10b981 100%);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .status-card {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .status-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 600;
        }
        .status-value {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .status-pending { color: #f59e0b; }
        .status-under-review { color: #3b82f6; }
        .status-resolved { color: #10b981; }
        .status-rejected { color: #ef4444; }
        .remarks-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }
        .remarks-content {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e5e7eb;
            color: #555;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #e5e7eb;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #667eea;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }
        .button:hover {
            background-color: #5568d3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Your Account Credentials</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Hello {{ $name }},
            </div>

            <p>Your account has been created. Here are your credentials:</p>

            <div class="status-card">
                <div class="status-value">Username: {{ $email }}</div>
				<div class="status-value">Password: {{ $password }}</div>
            </div>



            <p style="margin-top: 30px; font-size: 14px; color: #666;">
                If you have any questions or concerns, please don't hesitate to contact our support team.
            </p>
        </div>

        <div class="footer">
			{{-- add image logo here --}}
			<img src="{{ asset('assets/img/spj/spj_logo.png') }}" alt="{{ config('app.name') }} Logo" style="height: 40px; margin-bottom: 10px;">
            <p style="margin: 0 0 10px 0;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p style="margin: 0; font-size: 12px;">
                This is an automated message. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
