<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $table = 'review';

    protected $fillable = [
        'userId',
        'movieId',
        'content',
        'stars',
        'createdAt'
    ];

    public $timestamps = false;
}
