<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to JurisLocator</title>
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
        .success-icon {
            width: 60px;
            height: 60px;
            background: #28a745;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 24px;
            box-shadow: 0 4px 16px rgba(40, 167, 69, 0.3);
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
        .welcome-message {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
            padding: 20px;
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
        .btn:hover {
            background: #002B5B;
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
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="<?php echo e(asset('user_assets/img/logo-01.png')); ?>" alt="JurisLocator Logo" class="logo">
            <div class="success-icon"><i class="fas fa-check"></i></div>
            <h1 class="title">Welcome to JurisLocator!</h1>
            <p class="subtitle">Your account has been approved and is now active</p>
        </div>

        <div class="content">
            <p>Dear <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>,</p>

            <div class="welcome-message">
                <h3 style="margin: 0 0 10px 0; color: #155724;"><i class="fas fa-trophy" style="margin-right: 8px;"></i>Congratulations!</h3>
                <p style="margin: 0;">Your JurisLocator account has been approved by our administrators. You can now access all features of our legal research platform.</p>
            </div>

            <p>Your account details:</p>
            <ul>
                <li><strong>Email:</strong> <?php echo e($user->email); ?></li>
                <li><strong>User Type:</strong> <?php echo e(ucfirst($user->user_type)); ?></li>
                <li><strong>Trial Period:</strong> 7 days (started today)</li>
            </ul>

            <div style="text-align: center; margin: 30px 0;">
                <a href="<?php echo e(url('/login')); ?>" class="btn">Login to Your Account</a>
            </div>

            <div class="info-box">
                <h4 style="margin: 0 0 10px 0; color: #004085;"><i class="fas fa-list-check" style="margin-right: 8px;"></i>What's Next?</h4>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Log in to your account using your registered email and password</li>
                    <li>Explore our comprehensive legal database</li>
                    <li>Access Acts, Regulations, Case Law, and Immigration Programs</li>
                    <li>Create and manage your personal notes and templates</li>
                    <li>Set up important deadlines and reminders</li>
                </ul>
            </div>

            <div class="info-box">
                <h4 style="margin: 0 0 10px 0; color: #004085;"><i class="fas fa-clock" style="margin-right: 8px;"></i>Your 7-Day Free Trial</h4>
                <p style="margin: 0;">Your trial subscription is now active and includes full access to all JurisLocator features. You'll receive a notification before your trial expires.</p>
            </div>

            <div class="support-info">
                <h4 style="margin: 0 0 10px 0;"><i class="fas fa-headset" style="margin-right: 8px;"></i>Need Help?</h4>
                <p style="margin: 0;">Our support team is here to help you get started. Feel free to reach out if you have any questions.</p>
                <p style="margin: 5px 0 0 0;"><strong><i class="fas fa-envelope" style="margin-right: 5px;"></i>Email:</strong> support@jurislocator.com</p>
            </div>
        </div>

        <div class="footer">
            <p>Thank you for choosing JurisLocator for your legal research needs.</p>
            <p>&copy; <?php echo e(date('Y')); ?> JurisLocator. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\13\jurislocator_laravel\resources\views/emails/user-approved.blade.php ENDPATH**/ ?>