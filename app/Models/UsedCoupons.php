<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedCoupons extends Model
{
    use HasFactory;
    protected $fillable = [
        'c_id',
        'u_id',
        'u_name',
        'device_id',
        'date',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
