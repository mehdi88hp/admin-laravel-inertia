<?php

namespace Modules\Components\Admin\Genres\Controllers;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Modules\Components\Admin\Genres\Resources\GenreResource;
use Modules\Components\Admin\Genres\Services\GenresService;
use Modules\Models\Genre;

class GenresApiController
{
    public function index()
    {
        return GenreResource::collection(Genre::query()->paginate(
            request('count', 10),
            ['*'],
            'page',
            request('page', 1),
        ));
    }

    public function search(Request $request, GenresService $genresService)
    {
        $genres = Genre::query()->where('title', 'like', '%' . $request->term . '%')->get()
            ->map(fn($item) => ['id' => $item->id, 'title' => $item->title]);

        return $genres;
    }

    public function show(Genre $genres_api)
    {
        return new GenreResource($genres_api);
    }


    public function store(Request $request)
    {
        $request->validate(['title' => 'unique:genres,title']);

        $genreUrl = request()->file('poster')->store('/genres', 'public');

        /*
         you should run
        ln -s /var/www/vhosts/api1/storage/app/public/ /var/www/vhosts/api1/public/storage/ to create symlink
        the url are like http://blang.local/storage/public/uploads/Fd80ntX6pQSGtF95yRsga7Nhd63msAhiS12YUdkd.png
         * */

        //        return $fileSystem->put('/genres', request()->file('logo'));


        $genre = Genre::query()->create([
            'logo' => $genreUrl,
            'small_logo' => $genreUrl,
            'description' => request('description'),
            'title' => request('title'),
        ]);

        $parent = Genre::query()->find(request('parent'));

        if ($parent) {
            $parent->appendNode($genre);
        }

        return ['genre_id' => $genre->id];
    }

    public function update(Request $request, Genre $genres_api)
    {
        $request->validate(['title' => 'unique:genres,title,' . $genres_api->id]);

        $data = [
            'description' => request('description'),
            'title' => request('title'),
            'parent_id' => request('parent'),
        ];

        if (request('poster')) {
            $genreUrl = request()->file('poster')->store('/genres', 'public');
            $data['logo'] = $genreUrl;
            $data['small_logo'] = $genreUrl;
        }

        /*
         you should run
        ln -s /var/www/vhosts/api1/storage/app/public/ /var/www/vhosts/api1/public/storage/ to create symlink
        the url are like http://blang.local/storage/public/uploads/Fd80ntX6pQSGtF95yRsga7Nhd63msAhiS12YUdkd.png
         * */

        //        return $fileSystem->put('/genres', request()->file('logo'));
        $genre = Genre::query()->find($genres_api->id);
        $genre->forceFill($data);
        $genre->save();

        $parent = Genre::query()->find(request('parent'));

        if ($parent && $genre->parent_id != $genres_api->parent_id) {
            $parent->appendNode($genre);
        }

        return 'ok';
    }

    public function destroy(Genre $genres_api)
    {
        dd($genres_api);
    }
}
