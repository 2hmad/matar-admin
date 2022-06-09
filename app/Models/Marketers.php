<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketers extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon',
        'full_name',
        'email',
        'phone',
        'address',
        'country',
        'password',
        'coupon_expire',
        'reg_commission',
        'sub_commission',
        'facebook_acc',
        'twitter_acc',
        'instagram_acc',
        'tiktok_acc',
        'token',
        'pic',
        'ban',
        'active'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(MarketerDetails::class, 'marketer_id', 'id');
    }
}
