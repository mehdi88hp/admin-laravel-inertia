<?php

use App\Scaffolder\Services\ZipService;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Kaban\Components\Admin\Airlines\Controllers\AirlinesController;
use Symfony\Component\VarDumper\VarDumper;

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
Route::get('/', fn() => '<h1>welcome to scaffolder 🎃</h1>');

Route::get('/test', [\App\Scaffolder\Controllers\ScaffolderController::class, 'test'])
    ->name('test');

Route::get('/foo', [\App\Scaffolder\Controllers\ScaffolderController::class, 'foo'])
    ->name('foo');
