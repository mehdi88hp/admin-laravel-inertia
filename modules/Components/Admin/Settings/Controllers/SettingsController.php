<?php

namespace Modules\Components\Admin\Settings\Controllers;


use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Modules\Components\Admin\Setting\Services\SettingsService;

class SettingsController
{
    public function index()
    {
        return Inertia::render('Settings/Index', [
            'appUrl' => config('app.url')
        ]);
    }

    public function bulkInsert(Request $request, SettingsService $SettingsService)
    {
        return $SettingsService->bulkInsert(request('content'));
    }

}
