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
        'role',
        'pic',
        'date',
        'coupon',
        'ban'
    ];
    protected $hidden = [
        'password',
    ];
    public $timestamps = false;

    public function subscription()
    {
        return $this->hasMany(Subscriptions::class, 'user_id', 'id');
    }
}
