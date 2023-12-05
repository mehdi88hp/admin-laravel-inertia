<?php

use Illuminate\Support\Facades\Route;
use Modules\Components\Admin\Words\Controllers\WordsController;

Route::resource('/words', WordsController::class);
Route::post('/words/bulk', [WordsController::class, 'bulkInsert']);
//    ->except(['destroy', 'update']);
