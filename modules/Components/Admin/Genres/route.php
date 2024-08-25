<?php

use Illuminate\Support\Facades\Route;
use Modules\Components\Admin\Genres\Controllers\GenresApiController;
use Modules\Components\Admin\Genres\Controllers\GenresController;

Route::resource('/genres', GenresController::class);
Route::post('/genres-api/search', [GenresApiController::class,'search']);
Route::resource('/genres-api', GenresApiController::class);

//    ->except(['destroy', 'update']);
