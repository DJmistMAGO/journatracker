<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($itemType) }} Status Update</title>
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .header-subtitle {
            margin: 5px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }

        .content {
            padding: 30px;
        }

        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
            color: #333;
        }

        .item-card {
            background: linear-gradient(135deg, #fffbeb 0%, #f0fdf4 100%);
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #fbbf24;
        }

        .item-type {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #f59e0b;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .item-title {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-scheduled {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-revision {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-for-publish {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .publish-info {
            background-color: #ffffff;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .schedule-info {
            background-color: #ffffff;
            border-left: 4px solid #6366f1;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .publish-info-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #10b981;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            color: white;
            font-size: 12px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .schedule-info-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #6366f1;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            color: white;
            font-size: 12px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .publish-info-text {
            font-size: 15px;
            color: #1f2937;
        }

        .publish-date {
            font-weight: 600;
            color: #10b981;
        }

        .schedule-date {
            font-weight: 600;
            color: #6366f1;
        }

        .remarks-section {
            background-color: #fff7ed;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }

        .remarks-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #f59e0b;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .remarks-content {
            color: #78350f;
            font-size: 15px;
            line-height: 1.6;
        }

        .message {
            font-size: 15px;
            color: #4b5563;
            margin: 20px 0;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #10b981;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: 600;
        }

        .button:hover {
            background-color: #059669;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #e5e7eb;
        }

        .thank-you {
            font-size: 15px;
            color: #6b7280;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ ucfirst($itemType) }} Status Update</h1>
            <p class="header-subtitle">Your submission has been reviewed</p>
        </div>

        <div class="content">
            <div class="greeting">
                Hello {{ $userName }},
            </div>

            <div class="item-card">
                <div class="item-type">{{ ucfirst($itemType) }}</div>
                <div class="item-title">"{{ $itemTitle }}"</div>

                <div>
                    <span
                        class="status-badge
                        @if ($status === 'Published') status-published
                        @elseif($status === 'Scheduled') status-scheduled
                        @elseif($status === 'Pending') status-pending
                        @elseif($status === 'Revision') status-revision
                        @elseif($status === 'Rejected') status-rejected
                        @elseif($status === 'Approved') status-approved
                        @elseif($status === 'For Publish') status-for-publish
                        @else status-pending @endif">
                        {{ $status }}
                    </span>
                </div>
            </div>

            <p class="message">
                The status of your {{ $itemType }} has been updated to <strong>{{ $status }}</strong>.
            </p>

            @if($status === 'Scheduled')
                <div class="schedule-info">
                    <span class="schedule-info-icon">📅</span>
                    <span class="publish-info-text">
                        Scheduled for: <span class="schedule-date">{{ \Carbon\Carbon::parse($publish_at)->format('F d, Y') }} at {{ \Carbon\Carbon::parse($publish_at)->format('g:i A') }}</span>
                    </span>
                </div>
            @endif

            @if ($status === 'Published')
                <div class="publish-info">
                    <span class="publish-info-icon">✓</span>
                    <span class="publish-info-text">
                        Your {{ $itemType }} is now <span class="publish-date">live and visible to everyone!</span>
                    </span>
                </div>
            @endif

            @if (in_array($status, ['Revision', 'Rejected']) && isset($remarks) && $remarks)
                <div class="remarks-section">
                    <div class="remarks-label">Remarks from Reviewer</div>
                    <div class="remarks-content">
                        {{ $remarks }}
                    </div>
                </div>
            @endif

            @if ($status === 'Published')
                <p class="message">
                    🎉 Congratulations! Your {{ $itemType }} has been published and is now visible to everyone!
                </p>
            @elseif($status === 'Scheduled')
                <p class="message">
                    🕒 Your {{ $itemType }} has been scheduled and will automatically be published on the date and
                    time shown above.
                </p>
            @elseif($status === 'For Publish')
                <p class="message">
                    📰 Your {{ $itemType }} is ready and queued for publishing. It will be live soon!
                </p>
            @elseif($status === 'Approved')
                <p class="message">
                    ✅ Great work! Your {{ $itemType }} has been approved and is ready for publishing.
                </p>
            @elseif($status === 'Revision')
                <p class="message">
                    📝 Please review the remarks above and make the necessary revisions to your {{ $itemType }}.
                </p>
            @elseif($status === 'Rejected')
                <p class="message">
                    ❌ Unfortunately, your {{ $itemType }} did not meet the requirements. Please review the remarks
                    for more details.
                </p>
            @endif

            <p class="thank-you">
                Thank you for your contribution!
            </p>
        </div>

        <div class="footer">
            <p style="margin: 0 0 10px 0;">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
            <p style="margin: 0; font-size: 12px;">
                This is an automated message. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>

</html>
