<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon',
        'country',
        'days',
        'expire_date',
        'active'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function usedBy()
    {
        return $this->hasMany(UsedCoupons::class, 'c_id', 'id');
    }
}
