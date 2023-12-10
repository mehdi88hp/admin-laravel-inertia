<?php

namespace Modules\Components\Admin\Songs\Controllers;


use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Modules\Components\Admin\Songs\Services\SongsService;
use Modules\Models\Song;

class SongsController
{
    public function index()
    {
        return Inertia::render('Songs/Index', [
            'appUrl' => config('app.url')
        ]);
    }

    public function create()
    {
        return Inertia::render('Songs/Create', [
            'appUrl' => config('app.url')
        ]);
    }

    public function edit($id)
    {
        return Inertia::render('Songs/Edit', [
            'appUrl' => config('app.url'),
            'songId' => $id,
        ]);
    }

    public function store()
    {
        $song = Song::query()->create(['name' => request('name')]);

        return ['song_id' => $song->id];
    }

    public function update(Song $song, SongsService $songsService)
    {
        $words = $songsService->testUpdate($song, request('content'));
    }

    public function bulkInsert(Request $request, SongsService $songsService)
    {
        $words = $songsService->bulkInsert(request('content'));

//        $words->for
    }

}
