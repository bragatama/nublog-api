<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Protected Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('posts', PostController::class)->names('posts');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
