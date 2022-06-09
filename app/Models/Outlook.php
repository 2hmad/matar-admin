<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlook extends Model
{
    use HasFactory;
    public $table = "outlooks";
    protected $fillable = [
        'title',
        'date',
        'country',
        'details',
        'media',
        'schedule',
        'hide',
        'likes',
        'shares'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function comments()
    {
        return $this->hasMany(Comments::class, 'outlook_id', 'id');
    }
    public function files()
    {
        return $this->hasMany(OutlooksFiles::class, 'outlook_id', 'id');
    }
}
