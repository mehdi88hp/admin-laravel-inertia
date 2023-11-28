<?php
Route::get('/', fn() => '<h1>welcome to scaffolder 🎃</h1>');

Route::get('/test', [\App\Scaffolder\Controllers\ScaffolderController::class, 'test'])
    ->name('test');
