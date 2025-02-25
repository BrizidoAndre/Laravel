<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewEvaluation extends Model
{
    public $table = 'reviewevaluation';
    public $timestamps = false;

    protected $fillable = [
        'reviewId',
        'userId',
        'positive'
    ];
}
