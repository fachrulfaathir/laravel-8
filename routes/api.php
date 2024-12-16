<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Grouping routes that share the same middleware or controller namespace
Route::middleware('auth:api')->group(function () {
    // Protected routes with 'auth:api' middleware
    Route::apiResource('/post', App\Http\Controllers\PostController::class);
    Route::apiResource('/pegawai', App\Http\Controllers\PegawaiController::class);
    
    // Protected route for getting user info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Public routes (no authentication required)
Route::post('/register', App\Http\Controllers\Api\RegisterController::class, 'store')->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class, 'login')->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');