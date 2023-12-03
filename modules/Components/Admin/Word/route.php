<?php

use Illuminate\Support\Facades\Route;

Route::resource('/words', \Modules\Components\Admin\Word\Controllers\WordsController::class);
Route::post('/words/bulk', [\Modules\Components\Admin\Word\Controllers\WordsController::class, 'bulkInsert']);
//    ->except(['destroy', 'update']);
