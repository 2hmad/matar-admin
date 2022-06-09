<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'content',
        'date',
        'country',
        'appearance_for',
        'appearance_as',
        'redirect',
        'schedule',
        'media',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
