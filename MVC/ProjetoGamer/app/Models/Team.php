<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $table = 'team';

    protected $fillable = [
        'team_id',
        'name',
        'shield'
    ];

    public $timestamps = false;
}
