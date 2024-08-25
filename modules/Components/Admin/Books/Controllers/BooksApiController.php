<?php

namespace Modules\Components\Admin\Books\Controllers;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Modules\Components\Admin\Books\Resources\BookResource;
use Modules\Components\Admin\Books\Services\BooksService;
use Modules\Models\Book;
use Modules\Models\Genre;

class BooksApiController
{
    public function index()
    {
        return BookResource::collection(Book::query()->paginate(
            request('count', 10),
            ['*'],
            'page',
            request('page', 1),
        ));
    }

    public function search(Request $request, BooksService $booksService)
    {
        $genre = Genre::query()->where('title', 'like', '%' . $request->term . '%')->get()
            ->map(fn($item) => ['id' => $item->id, 'title' => $item->title]);

        return $genre;
    }

    public function show(Book $books_api)
    {
        return new BookResource($books_api);
    }


    public function store(Request $request)
    {
//        $request->validate(['title' => 'unique:books,title']);

        dd($request->all());
        $book = new Book([
            'title' => $request->title,
            'description' => $request->description,
            'genre' => $request->genre,
        ]);

        foreach ($request->sections as $section) {
            dd($section);
        }


        /*
         you should run
        ln -s /var/www/vhosts/api1/storage/app/public/ /var/www/vhosts/api1/public/storage/ to create symlink
        the url are like http://blang.local/storage/public/uploads/Fd80ntX6pQSGtF95yRsga7Nhd63msAhiS12YUdkd.png
         * */

        //        return $fileSystem->put('/books', request()->file('logo'));


        $book = Book::query()->create([
            'logo' => $bookUrl,
            'small_logo' => $bookUrl,
            'description' => request('description'),
            'title' => request('title'),
        ]);

        $parent = Book::query()->find(request('parent'));

        if ($parent) {
            $parent->appendNode($book);
        }

        return ['book_id' => $book->id];
    }

    public function update(Request $request, Book $books_api)
    {
        $request->validate(['title' => 'unique:books,title,' . $books_api->id]);

        $data = [
            'description' => request('description'),
            'title' => request('title'),
            'parent_id' => request('parent'),
        ];

        if (request('poster')) {
            $bookUrl = request()->file('poster')->store('/books', 'public');
            $data['logo'] = $bookUrl;
            $data['small_logo'] = $bookUrl;
        }

        /*
         you should run
        ln -s /var/www/vhosts/api1/storage/app/public/ /var/www/vhosts/api1/public/storage/ to create symlink
        the url are like http://blang.local/storage/public/uploads/Fd80ntX6pQSGtF95yRsga7Nhd63msAhiS12YUdkd.png
         * */

        //        return $fileSystem->put('/books', request()->file('logo'));
        $book = Book::query()->find($books_api->id);
        $book->forceFill($data);
        $book->save();

        $parent = Book::query()->find(request('parent'));

        if ($parent && $book->parent_id != $books_api->parent_id) {
            $parent->appendNode($book);
        }

        return 'ok';
    }

    public function destroy(Book $books_api)
    {
        dd($books_api);
    }
}
