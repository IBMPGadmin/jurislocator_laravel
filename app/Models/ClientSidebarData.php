<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientSidebarData extends Model
{
    use HasFactory;

    protected $table = 'user_pinned_popups';

    protected $fillable = [
        'user_id',
        'client_id',
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
        'client_id' => 'integer',
        'category_id' => 'integer',
    ];

    /**
     * Get the user that owns the pinned popup.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the client that owns the pinned popup.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Scope to filter by user and client
     */
    public function scopeForUserAndClient($query, $userId, $clientId)
    {
        return $query->where('user_id', $userId)->where('client_id', $clientId);
    }
}