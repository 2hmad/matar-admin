<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutlookShares extends Model
{
    use HasFactory;
    public $table = "outlooks_shares";
    protected $fillable = [
        'outlook_id',
        'user_id',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
