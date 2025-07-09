<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientNote extends Model
{
    use HasFactory;

    protected $table = 'client_notes';

    protected $fillable = [
        'user_id',
        'client_id',
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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
