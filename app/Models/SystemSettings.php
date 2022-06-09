<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'satellite_link',
        'affiliate_mode'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
