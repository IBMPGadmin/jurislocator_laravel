# ==========================================================
# EMAIL CONFIGURATION INSTRUCTIONS
# ==========================================================

## CURRENT ISSUE:
The approval confirmation emails are not being sent because the MAIL_PASSWORD 
is still set to placeholder value "YOUR_EMAIL_PASSWORD_HERE".

## SOLUTION 1: Fix immifocus.ca Email (Recommended)
1. Contact the owner of immifocus.ca domain to get the password for anuradha@immifocus.ca
2. Update .env file:
   MAIL_PASSWORD=actual_password_here
3. Run: php artisan config:clear
4. Test with: php test_email_debug.php your-test-email@domain.com

## SOLUTION 2: Use Gmail for Testing (Temporary)
If you can't get the immifocus.ca password immediately, you can use Gmail:

1. Create or use an existing Gmail account
2. Enable 2-Factor Authentication
3. Generate an App Password:
   - Go to Google Account settings
   - Security > 2-Step Verification > App passwords
   - Create password for "Mail"
4. Update .env file:
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-gmail@gmail.com
   MAIL_PASSWORD=your-app-password-here
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="your-gmail@gmail.com"
   MAIL_FROM_NAME="${APP_NAME}"

## SOLUTION 3: Use SendGrid (Professional)
For production, consider using SendGrid:
1. Sign up at sendgrid.com
2. Get API key
3. Update .env:
   MAIL_MAILER=sendgrid
   SENDGRID_API_KEY=your-api-key
   MAIL_FROM_ADDRESS="noreply@jurislocator.ca"

## CURRENT STATUS:
- ✅ SMTP connection to immifocus.ca works
- ✅ Email templates exist
- ✅ Approval workflow code is correct
- ❌ Authentication fails due to wrong password
- 👥 2 users are pending approval

## TESTING:
After fixing the password, test with:
php test_email_debug.php your-test-email@domain.com

## LOG MONITORING:
Check logs for email errors:
tail -f storage/logs/laravel.log | grep -i mail
