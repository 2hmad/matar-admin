<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    public $table = "support_tickets";
    protected $fillable = [
        'user_id',
        'subject',
        'content',
        'date',
        'active'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
