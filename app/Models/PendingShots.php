<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingShots extends Model
{
    use HasFactory;
    public $table = "pending_shots";
    protected $fillable = [
        'user_id',
        'photographer',
        'location',
        'send_date',
        'date',
        'media',
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
