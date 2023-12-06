<?php
Route::get('/', function () {
//    cache()->remember('yyy', null, function () {
//        return 50;
//    });
//    dd(cache()->get('yyy'));
    return '<h1>welcome to test 🎃</h1>';
});

Route::get('/test', [\App\Scaffolder\Controllers\ScaffolderController::class, 'test'])
    ->name('test');
