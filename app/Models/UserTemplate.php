<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTemplate extends Model
{
    use HasFactory;

    protected $table = 'user_templates';

    protected $fillable = [
        'user_id',
        'template_name',
        'template_content',
        'template_type',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'template_content' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get the user that owns the template
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get templates for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get active templates only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get templates by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('template_type', $type);
    }
}
