<?php

namespace App\Crawler\Services\DicDotCom;

use App\Crawler\Services\DicDotCom\GetMainCard\LunaDefinitions;

class GetMainCard
{
    public static function get(&$arr)
    {
        return function ($wordDefinitions) use (&$arr) {
            $node = $wordDefinitions->filter('[data-type="two-column-layout"]');
//            $arr[] = $node->each(LunaDefinitions::get());
//            $children = $wordDefinitions->children(); //you should grab nodes with this "data-type="word-definition-content"" instead of ->children // go and see the source
//            if ($children->count() > 1) {
//
//                $definitionsGroup = $children->first()->text();
//                try {
//                    $definitionsContent = $children->eq(1)->text();
//
//                } catch (\Exception $exception) {
//                    dd($wordDefinitions->children()->first()->text());
//                }
//                $arr[] = [
//                    'definitionsGroup' => $definitionsGroup,
//                    'definitionsContent' => $definitionsContent,
//                ];
//            }

//            dd($definitionsContent);
//            dd($definitionsGroup);
        };
    }
}
