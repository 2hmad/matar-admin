<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'redirect',
        'hide',
        'location',
        'country',
        'media'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function details()
    {
        return $this->hasMany(AdsDetails::class, 'ad_id', 'id');
    }
}
