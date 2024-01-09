<?php

namespace App\Crawler\Controllers;


use App\Crawler\Client;
use Modules\Models\DicDotCom;
use Modules\Models\DicDotComRaw;
use Modules\Models\Word;
use Symfony\Component\DomCrawler\Crawler;

class TestController
{
    public function preview($id)
    {
        return DicDotComRaw::query()->find($id)->raw;
    }

    public function process($id)
    {
        $raw = $this->preview($id);

        $crawler = new Crawler($raw);

//        $x = $crawler
//            ->filter('body [data-type="word-definitions"]')
//            ->first()->count();
//        dd($x->children()->eq(1)->text());

        $wordDefinitionsGroup = $crawler
            ->filter('body [data-type="word-definitions"]');


        $arr = [];
        $wordDefinitionsGroup->each(function ($wordDefinitions) use (&$arr) {
            $children = $wordDefinitions->children(); //you should grab nodes with this "data-type="word-definition-content"" instead of ->children // go and see the source
            if ($children->count() > 1) {

                $definitionsGroup = $children->first()->text();
                try {
                    $definitionsContent = $children->eq(1)->text();

                } catch (\Exception $exception) {
                    dd($wordDefinitions->children()->first()->text());
                }
                $arr[] = [
                    'definitionsGroup' => $definitionsGroup,
                    'definitionsContent' => $definitionsContent,
                ];
            }

//            dd($definitionsContent);
//            dd($definitionsGroup);
        });
        dd($arr);
        foreach ($wordDefinitionsGroup as $wordDefinitions) {
            $definitionsGroup = $wordDefinitions->children()->first()->text();
            dd($definitionsGroup);
        }
//            ->each(function ($node, $i) {
//                dd($node->text());
//                dd($node->filter(' *'););
//                $crawler = $node->filter(' *');
//                foreach ($crawler as $domElement) {
//                    $x[] = (trim($domElement->textContent));
//                }
//                return $x;
//            });

        dd($x);
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

    public function dictionaryDotCom($word)
    {
        $client = new Client();

//        $crawler = $client->jsonRequest('GET', 'https://www.dictionary.com/browse/' . $word, ['word' => 'triumph']);

        $wordModels = Word::query()
//            ->where('word', $word)
            ->limit(100)->get();

        foreach ($wordModels as $wordModel) {

            if ($c = DicDotComRaw::query()->where('word_id', $wordModel->id)->doesntExist()) {
                try {
                    $crawler = file_get_contents('https://www.dictionary.com/browse/' . $wordModel->word);
                } catch (\Exception $exception) {

                    dump($exception->getMessage(), $exception->getCode());
                    continue;
                }

                DicDotComRaw::query()->updateOrCreate([
                    'word_id' => $wordModel->id,
                ], [
                    'word' => $wordModel->word,
                    'raw' => $crawler,
                    'crawled_at' => now(),
                ]);
            }
        }


//        Crawler::
//        return ($crawler);
//        return ($crawler->text());
//        $crawler = $crawler
//            ->filter('body .word-row-side')
//            ->each(function ($node, $i) {
//                $crawler = $node->filter('small.badge-pill.badge-light.d-inline-block > a');
//                $x = [];
//                foreach ($crawler as $domElement) {
//                    $x[] = (trim($domElement->textContent));
//                }
//                return $x;
//            });
    }
}
