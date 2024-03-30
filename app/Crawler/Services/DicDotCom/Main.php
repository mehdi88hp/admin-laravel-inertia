<?php

namespace App\Crawler\Services\DicDotCom;

use App\Crawler\Services\DicDotCom\GetMainCard\LunaDefinitions;
use Modules\Models\DicDotComRaw;
use Symfony\Component\DomCrawler\Crawler;

class Main
{
    public function preview($id)
    {
        dd($id, DicDotComRaw::all()->last());
        return DicDotComRaw::query()->find(intval($id))->raw;
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
            ->filter('body [data-type="two-column-layout"] > section');

        $lunaDefinitions = $crawler
            ->filter('body [data-type="two-column-layout"] > section [data-type="luna-definitions"]');

        LunaDefinitions::get($lunaDefinitions);

        dd(1);

        $wordDefinitionsGroup->each(GetMainCard::get($arr));

        dd($lunaDefinitions);
        $arr = [];
        $wordDefinitionsGroup->each(GetMainCard::get($arr));
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
}
