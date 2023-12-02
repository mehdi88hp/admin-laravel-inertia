<?php

use Illuminate\Support\Facades\Route;

Route::resource('/words', \Modules\Components\Admin\Word\Controllers\WordController::class);
//    ->except(['destroy', 'update']);
