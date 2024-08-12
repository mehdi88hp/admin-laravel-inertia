<?php

use Illuminate\Support\Facades\Route;
use Modules\Components\Admin\Auth\Controllers\AuthController;

//Route::resource('/auth', AuthController::class);
Route::get('/auth/login', [AuthController::class,'loginForm'])->name('login');
Route::post('/auth/login', [AuthController::class,'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

Route::get('/auth/register', [AuthController::class,'registerForm']);
Route::post('/auth/register', [AuthController::class,'register']);
