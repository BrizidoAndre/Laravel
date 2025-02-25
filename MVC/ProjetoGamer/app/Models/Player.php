<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public $table = 'player';

    protected $fillable = [
        'player_id',
        'team_id',
        'name',
        'email',
        'password'
    ];

    public $timestamps = false;

    public function setPasswordAttribute() {
        $this->password = hash('sha256', $this->password);
    }
}
