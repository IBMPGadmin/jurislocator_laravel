<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPersonalPopup extends Model
{
    use HasFactory;

    protected $table = 'user_personal_popups';

    protected $fillable = [
        'user_id',
        'section_id',
        'category_id',
        'part',
        'division',
        'popup_content',
        'popup_title',
        'section_title',
        'table_name',
        'notes'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'category_id' => 'integer',
        'pinned_at' => 'datetime',
    ];

    /**
     * Get the user that owns the popup
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get popups for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get popups for a specific category
     */
    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope to get popups ordered by most recent
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('pinned_at', 'desc');
    }
}
