<?php

use Illuminate\Support\Facades\Route;
use Modules\Components\Admin\Books\Controllers\BooksApiController;
use Modules\Components\Admin\Books\Controllers\BooksController;

Route::resource('/books', BooksController::class);
Route::post('/books-api/search', [BooksApiController::class,'search']);
Route::resource('/books-api', BooksApiController::class);

//    ->except(['destroy', 'update']);
