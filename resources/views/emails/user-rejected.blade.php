<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JurisLocator Registration Update</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
        }
        .logo {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
        .warning-icon {
            width: 60px;
            height: 60px;
            background: #dc3545;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
            box-shadow: 0 4px 16px rgba(220, 53, 69, 0.3);
        }
        .icon {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        .title {
            color: #002B5B;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #6c757d;
            font-size: 16px;
        }
        .content {
            margin: 30px 0;
        }
        .rejection-message {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        .info-box {
            background: #e7f3ff;
            border: 1px solid #b8daff;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 14px;
        }
        .support-info {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background: #C19A6B;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('user_assets/img/logo-01.png') }}" alt="JurisLocator Logo" class="logo">
            <div class="warning-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <h1 class="title">Registration Update</h1>
            <p class="subtitle">Regarding your JurisLocator account application</p>
        </div>

        <div class="content">
            <p>Dear {{ $user->first_name }} {{ $user->last_name }},</p>

            <div class="rejection-message">
                <h3 style="margin: 0 0 10px 0; color: #721c24;"><i class="fas fa-times-circle" style="margin-right: 8px;"></i>Application Status Update</h3>
                <p style="margin: 0;">We appreciate your interest in JurisLocator. After careful review, we are unable to approve your account application at this time.</p>
            </div>

            <p>Your application details:</p>
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>User Type:</strong> {{ ucfirst($user->user_type) }}</li>
                <li><strong>Application Date:</strong> {{ $user->created_at->format('F d, Y') }}</li>
            </ul>

            <div class="info-box">
                <h4 style="margin: 0 0 10px 0; color: #004085;"><i class="fas fa-question-circle" style="margin-right: 8px;"></i>Why was my application not approved?</h4>
                <p style="margin: 0;">Applications may not be approved for various reasons, including:</p>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    <li>Incomplete or insufficient documentation</li>
                    <li>Verification requirements not met</li>
                    <li>Account information discrepancies</li>
                    <li>Platform eligibility criteria</li>
                </ul>
            </div>

            <div class="info-box">
                <h4 style="margin: 0 0 10px 0; color: #004085;"><i class="fas fa-redo" style="margin-right: 8px;"></i>What can I do next?</h4>
                <p style="margin: 0;">If you believe this decision was made in error or if you have additional information to support your application, please contact our support team.</p>
            </div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="mailto:support@jurislocator.com" class="btn">Contact Support</a>
            </div>

            <div class="support-info">
                <h4 style="margin: 0 0 10px 0;"><i class="fas fa-headset" style="margin-right: 8px;"></i>Need Assistance?</h4>
                <p style="margin: 0;">Our support team is available to help clarify any questions about your application or to assist with a new application if appropriate.</p>
                <p style="margin: 5px 0 0 0;"><strong><i class="fas fa-envelope" style="margin-right: 5px;"></i>Email:</strong> support@jurislocator.com</p>
                <p style="margin: 5px 0 0 0;"><strong><i class="fas fa-clock" style="margin-right: 5px;"></i>Business Hours:</strong> Monday - Friday, 9:00 AM - 5:00 PM</p>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for your interest in JurisLocator.</p>
            <p>&copy; {{ date('Y') }} JurisLocator. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
