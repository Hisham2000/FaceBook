<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $autoincrement = true;

    protected $fillable = [
        'content',
        'user_id',
        'post_image',
    ];
}

