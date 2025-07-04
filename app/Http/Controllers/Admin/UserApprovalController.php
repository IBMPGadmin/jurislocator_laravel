<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UserApprovalController extends Controller
{
    /**
     * Display pending user approvals
     */
    public function index()
    {
        $pendingUsers = User::where('approval_status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user-approvals.index', compact('pendingUsers'));
    }

    /**
     * Show user details for approval
     */
    public function show(User $user)
    {
        $user->load('approver');
        
        if (request()->ajax()) {
            return view('admin.user-approvals.show', compact('user'))->render();
        }
        
        return view('admin.user-approvals.show', compact('user'));
    }

    /**
     * Approve a user
     */
    public function approve(User $user)
    {
        $user->update([
            'approval_status' => 'approved',
            'approved_at' => Carbon::now(),
            'approved_by' => Auth::id(),
        ]);

        // Activate the user's trial subscription
        $subscription = UserSubscription::where('user_id', $user->id)->first();
        if ($subscription) {
            $subscription->update([
                'trial_starts_at' => Carbon::now(),
                'trial_ends_at' => Carbon::now()->addDays(7),
                'status' => 'trial'
            ]);
        }

        // Send approval email notification
        $emailSent = $this->sendApprovalEmail($user);

        $message = "User {$user->first_name} {$user->last_name} approved successfully.";
        if ($emailSent === false) {
            $message .= " However, the approval email could not be sent. Please check the email configuration.";
        } else {
            $message .= " Approval email sent.";
        }

        return redirect()->route('admin.user-approvals.index')->with('success', $message);
    }

    /**
     * Reject a user
     */
    public function reject(User $user)
    {
        $user->update([
            'approval_status' => 'rejected',
            'approved_at' => Carbon::now(),
            'approved_by' => Auth::id(),
        ]);

        // Update subscription status
        $subscription = UserSubscription::where('user_id', $user->id)->first();
        if ($subscription) {
            $subscription->update([
                'status' => 'rejected'
            ]);
        }

        // Send rejection email notification
        $emailSent = $this->sendRejectionEmail($user);

        $message = "User {$user->first_name} {$user->last_name} rejected.";
        if ($emailSent === false) {
            $message .= " However, the rejection email could not be sent. Please check the email configuration.";
        } else {
            $message .= " Rejection email sent.";
        }

        return redirect()->route('admin.user-approvals.index')->with('success', $message);
    }

    /**
     * Send approval email to user
     */
    private function sendApprovalEmail(User $user)
    {
        try {
            Log::info("Attempting to send approval email to: {$user->email}");
            
            Mail::send('emails.user-approved', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email, $user->first_name . ' ' . $user->last_name)
                        ->subject('Welcome to JurisLocator - Your Account is Now Active!')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            
            Log::info("Approval email sent successfully to: {$user->email}");
            return true;
            
        } catch (\Exception $e) {
            Log::error('Failed to send approval email to ' . $user->email . ': ' . $e->getMessage());
            Log::error('Email error stack trace: ' . $e->getTraceAsString());
            
            // Check common email configuration issues
            if (strpos($e->getMessage(), 'authentication') !== false) {
                Log::error('Email authentication failed - check MAIL_PASSWORD in .env file');
            }
            if (strpos($e->getMessage(), 'Connection refused') !== false) {
                Log::error('Email connection refused - check MAIL_HOST and MAIL_PORT in .env file');
            }
            
            return false;
        }
    }

    /**
     * Send rejection email to user
     */
    private function sendRejectionEmail(User $user)
    {
        try {
            Log::info("Attempting to send rejection email to: {$user->email}");
            
            Mail::send('emails.user-rejected', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email, $user->first_name . ' ' . $user->last_name)
                        ->subject('JurisLocator Registration Update')
                        ->from(config('mail.from.address'), config('mail.from.name'));
            });
            
            Log::info("Rejection email sent successfully to: {$user->email}");
            return true;
            
        } catch (\Exception $e) {
            Log::error('Failed to send rejection email to ' . $user->email . ': ' . $e->getMessage());
            Log::error('Email error stack trace: ' . $e->getTraceAsString());
            
            // Check common email configuration issues
            if (strpos($e->getMessage(), 'authentication') !== false) {
                Log::error('Email authentication failed - check MAIL_PASSWORD in .env file');
            }
            if (strpos($e->getMessage(), 'Connection refused') !== false) {
                Log::error('Email connection refused - check MAIL_HOST and MAIL_PORT in .env file');
            }
            
            return false;
        }
    }
}
