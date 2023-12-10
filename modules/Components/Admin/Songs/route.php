<?php

use Illuminate\Support\Facades\Route;
use Modules\Components\Admin\Songs\Controllers\SongsController;

Route::resource('/songs', SongsController::class);
Route::post('/songs/bulk', [SongsController::class, 'bulkInsert']);
//    ->except(['destroy', 'update']);
