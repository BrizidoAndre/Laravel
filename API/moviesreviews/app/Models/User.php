<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'user';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    public $timestamps = false;

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = hash('sha256', $value);
    }

    public static function generateToken(User $user) {
        $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = base64_encode(json_encode(['id' => $user->id, 'username' => $user->username, 'time' => time()]));
        $sig = base64_encode(hash_hmac('sha256', "$header.$payload", 'the lighthouse'));
        $token = "$header.$payload.$sig";

        AccessToken::create([
            'userId' => $user->id,
            'tokenString' => $token,
            'creationDate' => date_create()
        ]);

        return $token;
    }
}
