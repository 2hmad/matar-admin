<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    public $table = 'outlooks_comments';
    protected $fillable = [
        'outlook_id',
        'user_id',
        'comment',
        'reply',
        'date'
    ];
    protected $hidden = [];
    public $timestamps = false;

    public function outlook()
    {
        return $this->belongsTo(Outlook::class, 'outlook_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
