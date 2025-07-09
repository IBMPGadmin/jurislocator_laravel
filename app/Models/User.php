<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'user_type',
        'license_number',
        'student_id_number',
        'student_id_file',
        'company_name',
        'approval_status',
        'approved_at',
        'approved_by',
        'role', // Add role to fillable
        'profile_image', // Add profile_image to fillable
        'pinned_timezones', // Add pinned_timezones to fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'pinned_timezones' => 'array',
        ];
    }

    /**
     * Get the user's current subscription.
     */
    public function subscription()
    {
        return $this->hasOne(UserSubscription::class)->latest('id')->first();
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function activeSubscription()
    {
        return $this->subscriptions()
            ->where(function($query) {
                $query->where('status', 'active')
                    ->orWhere(function ($query) {
                        $query->where('status', 'trial')
                            ->where('trial_ends_at', '>', now());
                    });
            })
            ->latest('id')
            ->first();
    }
    
    /**
     * Check if user is approved
     */
    public function isApproved()
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Check if user is pending approval
     */
    public function isPending()
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Check if user is rejected
     */
    public function isRejected()
    {
        return $this->approval_status === 'rejected';
    }

    /**
     * Get the user who approved this user
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
