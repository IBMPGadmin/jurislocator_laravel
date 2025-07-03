<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPopupData extends Model
{
    use HasFactory;

    protected $table = 'user_popup_data';

    protected $fillable = [
        'user_id',
        'table_name',
        'category_id',
        'popup_data',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'popup_data' => 'array'
    ];

    /**
     * Get the user that owns the popup data
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get popup data for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get popup data for a specific document
     */
    public function scopeForDocument($query, $tableName, $categoryId)
    {
        return $query->where('table_name', $tableName)
                    ->where('category_id', $categoryId);
    }

    /**
     * Get or create user popup data for a specific document
     */
    public static function getOrCreateForUser($userId, $tableName, $categoryId)
    {
        return self::firstOrCreate([
            'user_id' => $userId,
            'table_name' => $tableName,
            'category_id' => $categoryId
        ], [
            'popup_data' => []
        ]);
    }
}
