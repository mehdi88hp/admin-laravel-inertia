<?php

namespace Modules\Components\Admin\Genres\Controllers;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Components\Admin\Genres\Services\GenresService;
use Modules\Models\Genre;

class GenresController
{
    public function index()
    {
//        $book = Book::query()->first();
//        $book->genres()->attach(1);
//        dd($book->genres()->where(['title' => 'horror'])->first());
        return Inertia::render('Genres/Index', [
            'appUrl' => config('app.url')
        ]);
    }

    public function create()
    {
        return Inertia::render('Genres/Create', [
            'appUrl' => config('app.url')
        ]);
    }

    public function edit(Genre $genre)
    {
        return Inertia::render('Genres/Edit', [
            'genre' => $genre->only(
                ['id']
            ),
            'appUrl' => config('app.url'),
        ]);
    }
}
