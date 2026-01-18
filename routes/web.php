<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


Route::redirect('/', '/login');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// Post routes
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', App\Http\Controllers\PostController::class);
});
