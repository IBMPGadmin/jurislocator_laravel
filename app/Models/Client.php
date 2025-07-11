<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
    // Set the table name explicitly to match the migration
    protected $table = 'client_table';
    
    protected $fillable = [
        'client_name',
        'client_email',
        'client_status',
        'user_id',
        'last_accessed'
    ];
    
    // Cast dates to Carbon instances
    protected $casts = [
        'last_accessed' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}