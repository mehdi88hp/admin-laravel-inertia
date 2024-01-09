<?php

namespace Modules\Components\Admin\CrawlData\Controllers;

use App\Crawler\Client;
use Modules\Models\DicDotCom;
use Modules\Models\Word;

class DictionaryDotComController
{
    public function preview($id)
    {
        return DicDotCom::query()->find($id)->raw;
    }

    public function test()
    {
        return $this->dictionaryDotCom(request('w'));
        $client = new Client();

        $crawler = $client->jsonRequest('GET', 'https://dic.b-amooz.com/en/dictionary/w', ['word' => 'triumph']);

        $crawler = $crawler
            ->filter('body .word-row-side')
            ->each(function ($node, $i) {
                $crawler = $node->filter('small.badge-pill.badge-light.d-inline-block > a');
                $x = [];
                foreach ($crawler as $domElement) {
                    $x[] = (trim($domElement->textContent));
                }
                return $x;
            });

        dd($crawler);
    }

    public function getPages()
    {
        $client = new Client();

//        $crawler = $client->jsonRequest('GET', 'https://www.dictionary.com/browse/' . $word, ['word' => 'triumph']);

        $wordModels = Word::query()
//            ->where('word', $word)
            ->limit(500)->get();

        foreach ($wordModels as $wordModel) {
            $is_404 = 0;
            $hasError = 0;

            if ($c = DicDotCom::query()->where('word_id', $wordModel->id)->doesntExist()) {
                try {
                    $crawler = file_get_contents('https://www.dictionary.com/browse/' . $wordModel->word);
                } catch (\Exception $exception) {

                    if (str_contains($exception->getMessage(), '404')) {
                        $hasError = $is_404 = 1;
                    }
                }

                DicDotCom::query()->updateOrCreate([
                    'word_id' => $wordModel->id,
                ], [
                    'word' => $wordModel->word,
                    'raw' => !$hasError ? $crawler : null,
                    'crawled_at' => now(),
                    'is_404' => $is_404
                ]);
            }
        }
    }
}
