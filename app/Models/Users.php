<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'country',
        'phone',
        'facebook_token',
        'google_token',
        'token',
        'pic',
        'date',
        'coupon',
        'ban'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
