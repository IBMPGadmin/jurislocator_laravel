<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== JurisLocator Email Debugging Tool ===\n\n";

function testEmailConfig() {
    echo "📧 Current Email Configuration:\n";
    echo "MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
    echo "MAIL_HOST: " . env('MAIL_HOST') . "\n";
    echo "MAIL_PORT: " . env('MAIL_PORT') . "\n";
    echo "MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";
    echo "MAIL_PASSWORD: " . (env('MAIL_PASSWORD') === 'YOUR_EMAIL_PASSWORD_HERE' ? '❌ PLACEHOLDER - NEEDS REAL PASSWORD!' : '✅ Set (hidden)') . "\n";
    echo "MAIL_ENCRYPTION: " . env('MAIL_ENCRYPTION') . "\n";
    echo "MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n";
    echo "MAIL_FROM_NAME: " . env('MAIL_FROM_NAME') . "\n\n";
    
    if (env('MAIL_PASSWORD') === 'YOUR_EMAIL_PASSWORD_HERE') {
        echo "🚨 CRITICAL ERROR: Password is not set!\n";
        echo "To fix this:\n";
        echo "1. Contact the email provider (immifocus.ca) to get the password for anuradha@immifocus.ca\n";
        echo "2. Update the .env file: MAIL_PASSWORD=actual_password_here\n";
        echo "3. Run: php artisan config:clear\n";
        echo "4. Run this test again\n\n";
        return false;
    }
    return true;
}

function testEmailTemplates() {
    echo "📄 Checking Email Templates:\n";
    $approvalTemplate = resource_path('views/emails/user-approved.blade.php');
    $rejectionTemplate = resource_path('views/emails/user-rejected.blade.php');
    
    echo "Approval template: " . (file_exists($approvalTemplate) ? '✅ Found' : '❌ Missing') . "\n";
    echo "Rejection template: " . (file_exists($rejectionTemplate) ? '✅ Found' : '❌ Missing') . "\n\n";
}

function testSmtpConnection() {
    echo "🔗 Testing SMTP Connection:\n";
    
    $host = env('MAIL_HOST');
    $port = env('MAIL_PORT');
    $encryption = env('MAIL_ENCRYPTION');
    
    echo "Connecting to {$host}:{$port} with {$encryption} encryption...\n";
    
    try {
        $socket = @fsockopen($host, $port, $errno, $errstr, 10);
        if ($socket) {
            echo "✅ Connection successful\n";
            fclose($socket);
        } else {
            echo "❌ Connection failed: {$errstr} ({$errno})\n";
        }
    } catch (Exception $e) {
        echo "❌ Connection error: " . $e->getMessage() . "\n";
    }
    echo "\n";
}

function testEmailSend($testEmail = null) {
    if (!$testEmail) {
        echo "⚠️  Skipping email send test (no test email provided)\n\n";
        return;
    }
    
    echo "📨 Testing Email Send to: {$testEmail}\n";
    
    try {
        Mail::send('emails.user-approved', [
            'user' => (object) [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => $testEmail
            ]
        ], function ($message) use ($testEmail) {
            $message->to($testEmail, 'Test User')
                    ->subject('JurisLocator Test Email');
        });
        
        echo "✅ Email sent successfully\n";
        echo "Check the recipient's inbox and spam folder\n";
    } catch (Exception $e) {
        echo "❌ Email send failed: " . $e->getMessage() . "\n";
        echo "This error has been logged to storage/logs/laravel.log\n";
    }
    echo "\n";
}

function showRecentLogs() {
    echo "📋 Recent Email Errors from Logs:\n";
    $logFile = storage_path('logs/laravel.log');
    
    if (!file_exists($logFile)) {
        echo "No log file found\n\n";
        return;
    }
    
    $lines = file($logFile);
    $emailErrors = [];
    
    foreach (array_reverse($lines) as $line) {
        if (strpos($line, 'Failed to send') !== false && strpos($line, 'email') !== false) {
            $emailErrors[] = $line;
            if (count($emailErrors) >= 3) break; // Show last 3 errors
        }
    }
    
    if (empty($emailErrors)) {
        echo "No recent email errors found\n";
    } else {
        foreach ($emailErrors as $error) {
            echo "❌ " . trim($error) . "\n";
        }
    }
    echo "\n";
}

function checkPendingUsers() {
    echo "👥 Checking Pending Users:\n";
    $pendingUsers = User::where('approval_status', 'pending')->count();
    echo "Pending users waiting for approval: {$pendingUsers}\n\n";
}

// Run all tests
testEmailConfig();
testEmailTemplates();
testSmtpConnection();
showRecentLogs();
checkPendingUsers();

// If password is set, offer to test email sending
if (env('MAIL_PASSWORD') !== 'YOUR_EMAIL_PASSWORD_HERE') {
    echo "🧪 To test email sending, run:\n";
    echo "php test_email_debug.php your-test-email@domain.com\n\n";
    
    // If test email provided as argument
    if (isset($argv[1]) && filter_var($argv[1], FILTER_VALIDATE_EMAIL)) {
        testEmailSend($argv[1]);
    }
}

echo "=== Email Debug Complete ===\n";
echo "If you need further help:\n";
echo "1. Make sure MAIL_PASSWORD is set in .env\n";
echo "2. Contact immifocus.ca support if you don't have the password\n";
echo "3. Consider using a different email service (Gmail, SendGrid, etc.) for testing\n";
echo "4. Check storage/logs/laravel.log for detailed error messages\n";
