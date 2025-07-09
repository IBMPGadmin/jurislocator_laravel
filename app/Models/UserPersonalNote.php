<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonalNote extends Model
{
    use HasFactory;

    protected $table = 'user_personal_notes';

    protected $fillable = [
        'user_id',
        'note_title',
        'note_content',
        'saved_at'
    ];

    protected $casts = [
        'saved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
