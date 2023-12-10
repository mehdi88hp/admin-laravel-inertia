<?php

namespace Modules\Components\Admin\Songs\Services;

use Modules\Models\Song;
use Modules\Models\Word;

class SongsService
{
    public function bulkInsert(string $content)
    {
        $content = str_replace('.', ' ', $content);
        $content = str_replace("\n", ' ', $content);
        $content = str_replace("n't", '', $content);

        $contentArray = explode(' ', $content);

        $words = [];
        $time = 1;
        foreach ($contentArray as $item) {
            $trimed = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $item));

            $word = Word::query()->firstOrCreate(['word' => $trimed]);

            $words[] = $word;
        }

        return $words;
    }

    public function testUpdate($song, $request)
    {
        $words = $this->bulkInsert($request);

        $sync = [];
        $time = 1;
        foreach ($words as $word) {
            $sync[$word->id] = [
                'offset_time' => $time * 10
            ];
            $time++;
        }
        $song->words()->sync($sync);
    }
}
