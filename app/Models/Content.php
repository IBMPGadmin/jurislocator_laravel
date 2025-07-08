<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'client_id',
        'context',
        'editor_content',
        'droppable_content',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relationship to client (if applicable)
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
