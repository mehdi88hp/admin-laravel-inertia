<?php

namespace Modules\Components\Admin\Words\Services;

use Modules\Models\Word;

class WordsService
{
    public function bulkInsert(string $content)
    {
        $content = str_replace('.', ' ', $content);
        $content = str_replace("\n", ' ', $content);
        $content = str_replace("n't", '', $content);

        $contentArray = explode(' ', $content);

        foreach ($contentArray as $item) {
            $trimed = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $item));

            Word::query()->firstOrCreate(['word' => $trimed]);
        }
    }
}
