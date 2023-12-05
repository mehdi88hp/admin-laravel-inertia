<?php

use Illuminate\Support\Facades\Route;
use Modules\Components\Admin\Settings\Controllers\SettingsController;

Route::resource('/settings', SettingsController::class);
//    ->except(['destroy', 'update']);
