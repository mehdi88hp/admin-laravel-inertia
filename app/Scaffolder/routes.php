<?php
Route::get('/com-builder', [\App\Scaffolder\Controllers\ScaffolderController::class, 'index'])
    ->name('com-builder.create');


Route::post('/com-builder', [\App\Scaffolder\Controllers\ScaffolderController::class, 'store'])
    ->name('com-builder.store');
