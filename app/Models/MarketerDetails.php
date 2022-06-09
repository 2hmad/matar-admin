<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketerDetails extends Model
{
    use HasFactory;

    public $table = 'marketer_details';
    protected $fillable = [
        'marketer_id',
        'user_id',
        'type',
        'amount',
        'date',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
