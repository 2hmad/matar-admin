<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsDetails extends Model
{
    use HasFactory;
    public $table = 'ads_details';
    protected $fillable = [
        'ad_id',
        'country',
        'count',
        'type'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
