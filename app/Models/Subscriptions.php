<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'start_date',
        'expire_date',
        'marketer_name',
        'pay_method',
        'active'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
