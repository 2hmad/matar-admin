<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangePassword extends Model
{
    use HasFactory;
    public $table = 'change_password';
    protected $fillable = [
        'user',
        'marketer',
        'token',
        'code',
        'expire_time'
    ];
    protected $hidden = [];
    public $timestamps = false;
}
