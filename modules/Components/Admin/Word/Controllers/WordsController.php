<?php

namespace Modules\Components\Admin\Word\Controllers;


use Illuminate\Support\Facades\Request;
use Modules\Components\Admin\Word\Services\WordsService;

class WordsController
{
    public function index()
    {
        return (request()->all());
    }

    public function bulkInsert(Request $request, WordsService $wordsService)
    {
        return $wordsService->bulkInsert(request('content'));
    }

}
