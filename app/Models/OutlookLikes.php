<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutlookLikes extends Model
{
    use HasFactory;
    public $table = "outlooks_likes";
    protected $fillable = [
        'outlook_id',
        'user_id',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
