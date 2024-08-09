<?php

use Illuminate\Support\Facades\Route;
use Modules\Components\Admin\Auth\Controllers\AuthController;

//Route::resource('/auth', AuthController::class);
Route::get('/auth/login', [AuthController::class,'login']);
Route::get('/auth/register', [AuthController::class,'registerForm']);
Route::post('/auth/register', [AuthController::class,'register']);
