<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('users');
});

// users
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/view/{id}', [UserController::class, 'view'])->name('users.view');
Route::post('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');

// animals
Route::resource('animals', AnimalController::class);