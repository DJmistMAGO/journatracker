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
            <h1>Report Status Update</h1>
        </div>

        <div class="content">
            <div class="greeting">
                Hello {{ $studentName }},
            </div>

            <p>We wanted to update you on the status of your reported problem.</p>

            <div class="status-card">
                <div class="status-label">Current Status</div>
                <div class="status-value
                    @if($status === 'Pending') status-pending
                    @elseif($status === 'Under Review') status-under-review
                    @elseif($status === 'Resolved') status-resolved
                    @elseif($status === 'Rejected') status-rejected
                    @endif">
                    {{ $status }}
                </div>

                @if($description)
                <div class="remarks-section">
                    <div class="status-label">Your Report</div>
                    <div class="remarks-content">
                        {{ $description }}
                    </div>
                </div>
                @endif
            </div>

            @if($status === 'Pending')
                <p>Your report has been received and is waiting to be reviewed by our team. We'll notify you once there's an update.</p>
            @elseif($status === 'Under Review')
                <p>Our team is currently investigating your report. We appreciate your patience as we work to address the issue.</p>
            @elseif($status === 'Resolved')
                <p>Great news! The issue you reported has been resolved. Thank you for bringing this to our attention.</p>
            @elseif($status === 'Rejected')
                <p>After careful review, we were unable to proceed with your report.</p>
            @endif

            <p style="margin-top: 30px; font-size: 14px; color: #666;">
                If you have any questions or concerns, please don't hesitate to contact our support team.
            </p>
        </div>

        <div class="footer">
            <p style="margin: 0 0 10px 0;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p style="margin: 0; font-size: 12px;">
                This is an automated message. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>
