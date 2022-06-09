<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'role',
        'token',
        'pic',
        'ban',
        'register_date'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
