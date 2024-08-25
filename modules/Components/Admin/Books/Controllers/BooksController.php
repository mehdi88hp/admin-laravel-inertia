<?php

namespace Modules\Components\Admin\Books\Controllers;


use Inertia\Inertia;
use Modules\Models\Book;

class BooksController
{
    public function index()
    {
        return Inertia::render('Books/Index', [
            'appUrl' => config('app.url')
        ]);
    }

    public function create()
    {
        return Inertia::render('Books/Create', [
            'appUrl' => config('app.url')
        ]);
    }

    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book->only(
                ['id']
            ),
            'appUrl' => config('app.url'),
        ]);
    }
}
