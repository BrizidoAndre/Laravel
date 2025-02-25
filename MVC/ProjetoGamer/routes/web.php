<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;




// Times

Route::controller(TeamController::class)->group(function() {
    Route::get('/equipes', 'index')->name('app.equipes');
    Route::post('/equipes/criar', 'store')->name('app.equipes.store');
    Route::get('/equipes/deletar/{team_id}', 'destroy')->name('app.equipes.delete');
    Route::post('/equipes/editar/{team_id}', 'edit')->name('app.equipes.edit');
    Route::post('/equipes/atualizar/{team_id}', 'update')->name('app.equipes.update');
});

// Jogadores

Route::controller(PlayerController::class)->group(function() {
    Route::get('/jogadores', 'index')->name('app.jogadores');
    Route::post('/jogadores', 'store')->name('app.jogadores.store');
});

Route::get('/', fn() => redirect('/home'));

Route::view('/home', 'home')->name('app.home');
Route::view('/login', 'login')->name('app.login');
