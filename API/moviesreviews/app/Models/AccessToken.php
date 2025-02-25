<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    public $table = 'accesstoken';

    protected $fillable = [
        'userId',
        'tokenString',
        'creationDate'
    ];

    public $timestamps = false;

}
