<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutlooksFiles extends Model
{
    use HasFactory;
    public $table = "outlooks_files";
    protected $fillable = [
        'outlook_id',
        'file',
    ];
    protected $hidden = [];
    public $timestamps = false;
}
