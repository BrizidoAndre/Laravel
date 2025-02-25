<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewEvaluationController;
use App\Http\Middleware\TokenValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('v1/auth/signup', [AuthController::class, 'signup']);
Route::post('v1/auth/signin', [AuthController::class, 'signin']);


Route::middleware(TokenValidation::class)->group(function () {
    Route::delete('v1/auth/signout', [AuthController::class, 'signout']);

    // movies
    Route::get('v1/movies', [MovieController::class, 'movies']);
    Route::get('v1/movies/{id}', [MovieController::class, 'view']);
    
    // artists
    Route::get('v1/artists', [ArtistController::class, 'artists']);
    Route::get('v1/artists/{id}', [ArtistController::class, 'view']);

    // reviews
    Route::post('v1/reviews/{movieId}', [ReviewController::class, 'create']);
    Route::get('v1/reviews/{movieId}', [ReviewController::class, 'reviews']);
    Route::delete('v1/reviews/{movieId}', [ReviewController::class, 'delete']);

    // reviews evaluations
    Route::post('v1/reviews/evaluations/{reviewId}', [ReviewEvaluationController::class, 'create']);
    Route::delete('v1/reviews/evaluations/{reviewId}', [ReviewEvaluationController::class, 'delete']);
    
    // genres
    Route::get('v1/genres', [GenreController::class, 'genres']);
    
    //medias
    Route::get('v1/media/{mediaId}', [MediaController::class, 'media']);
});
