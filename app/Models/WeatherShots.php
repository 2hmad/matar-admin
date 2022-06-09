<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherShots extends Model
{
    use HasFactory;
    public $table = 'weather_shots';
    protected $fillable = [
        'photographer',
        'location',
        'date',
        'schedule',
        'hide',
        'shares',
        'media'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
