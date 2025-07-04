<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Email Configuration Test ===\n";
echo "MAIL_MAILER: " . env('MAIL_MAILER') . "\n";
echo "MAIL_HOST: " . env('MAIL_HOST') . "\n";
echo "MAIL_PORT: " . env('MAIL_PORT') . "\n";
echo "MAIL_USERNAME: " . env('MAIL_USERNAME') . "\n";
echo "MAIL_PASSWORD: " . (env('MAIL_PASSWORD') === 'YOUR_EMAIL_PASSWORD_HERE' ? 'PLACEHOLDER - NEEDS REAL PASSWORD!' : 'Set (hidden)') . "\n";
echo "MAIL_ENCRYPTION: " . env('MAIL_ENCRYPTION') . "\n";
echo "MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n";
echo "\n";

if (env('MAIL_PASSWORD') === 'YOUR_EMAIL_PASSWORD_HERE') {
    echo "❌ ERROR: The MAIL_PASSWORD is still set to placeholder value!\n";
    echo "Please update the MAIL_PASSWORD in your .env file with the actual password for anuradha@immifocus.ca\n";
    echo "\n";
    echo "Steps to fix:\n";
    echo "1. Open .env file\n";
    echo "2. Replace 'YOUR_EMAIL_PASSWORD_HERE' with the actual password\n";
    echo "3. Run: php artisan config:clear\n";
    echo "4. Test again\n";
} else {
    echo "✅ Password is set to a real value\n";
    
    // Test email sending
    echo "\n=== Testing Email Send ===\n";
    try {
        Mail::raw('This is a test email from JurisLocator', function ($message) {
            $message->to('test@example.com')
                    ->subject('JurisLocator Email Test');
        });
        echo "✅ Email test completed - check logs for any errors\n";
    } catch (Exception $e) {
        echo "❌ Email test failed: " . $e->getMessage() . "\n";
    }
}
