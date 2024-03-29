<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cr', [\App\Crawler\Controllers\TestController::class, 'test']);
Route::get('/cr/preview/{id}', [\App\Crawler\Controllers\TestController::class, 'preview']);
Route::get('/cr/process/{id}', [\App\Crawler\Controllers\TestController::class, 'process']);

Route::get('/test', function () {
//    cache()->remember('xxx', -1, function () {
//        return 5;
//    });
//    dd(cache()->get('xxx'));
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function () {
//    cache()->remember('xxx', -1, function () {
//        return 5;
//    });
    dd(132);
//    dd(cache()->get('xxx'));
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/foo', [\App\Scaffolder\Controllers\ScaffolderController::class, 'foo'])
    ->name('food');

const COMPONENT_ROOT = __DIR__ . '/../modules/Components/';

require COMPONENT_ROOT . 'General/route.php';
require COMPONENT_ROOT . 'Admin/User/route.php';
require COMPONENT_ROOT . 'Admin/Words/route.php';
require COMPONENT_ROOT . 'Admin/Settings/route.php';
require COMPONENT_ROOT . 'Admin/Songs/route.php';
require COMPONENT_ROOT . 'Admin/CrawlData/route.php';

Route::get('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});
