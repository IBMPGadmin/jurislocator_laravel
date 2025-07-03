<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTextData extends Model
{
    use HasFactory;

    protected $table = 'user_text_data';

    protected $fillable = [
        'user_id',
        'table_name',
        'category_id',
        'text_content',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'text_content' => 'array'
    ];

    /**
     * Get the user that owns the text data
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get text data for a specific user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope to get text data for a specific document
     */
    public function scopeForDocument($query, $tableName, $categoryId)
    {
        return $query->where('table_name', $tableName)
                    ->where('category_id', $categoryId);
    }

    /**
     * Get or create user text data for a specific document
     */
    public static function getOrCreateForUser($userId, $tableName, $categoryId)
    {
        return self::firstOrCreate([
            'user_id' => $userId,
            'table_name' => $tableName,
            'category_id' => $categoryId
        ], [
            'text_content' => []
        ]);
    }
}
