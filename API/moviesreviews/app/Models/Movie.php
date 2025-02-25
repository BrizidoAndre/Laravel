<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $table = 'movie';
    public $timestamps = false;

    public static function formatDuration($movie) {
        $hours = intdiv($movie->durationMinutes, 60);
        $minutes = $movie->durationMinutes % 60;
        return $hours.'h'.$minutes.'m';
    }

    public static function getScore($movie) {
        return intval(Review::where('movieId', $movie->id)->avg('stars'));
    }
}
