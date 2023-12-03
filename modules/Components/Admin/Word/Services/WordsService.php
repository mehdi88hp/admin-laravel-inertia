<?php

namespace Modules\Components\Admin\Word\Services;

use Modules\Models\Word;

class WordsService
{
    public function bulkInsert(string $content)
    {
        $contentArray = explode(' ', $content);

        foreach ($contentArray as $item) {
            $trimed = str_replace([',', ':'], '', $item);
            Word::query()->firstOrCreate(['word' => $trimed]);
        }
    }
}
