<?php

namespace Modules\Components\Admin\Words\Controllers;


use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Modules\Components\Admin\Words\Services\AuthService;

class WordsController
{
    public function index()
    {
        return Inertia::render('Words/Index', [
            'appUrl' => config('app.url')
        ]);
    }

    public function bulkInsert(Request $request, AuthService $wordsService)
    {
        return $wordsService->bulkInsert(request('content'));
    }

}
