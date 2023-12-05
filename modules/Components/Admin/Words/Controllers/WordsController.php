<?php

namespace Modules\Components\Admin\Words\Controllers;


use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Modules\Components\Admin\Word\Services\WordsService;

class WordsController
{
    public function index()
    {
        return Inertia::render('Words/Index', [
            'appUrl' => config('app.url')
        ]);
    }

    public function bulkInsert(Request $request, WordsService $wordsService)
    {
        return $wordsService->bulkInsert(request('content'));
    }

}
