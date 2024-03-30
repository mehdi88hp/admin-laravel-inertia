<?php

namespace App\Crawler\Services\DicDotCom\GetMainCard;

use Symfony\Component\DomCrawler\Crawler;

class LunaDefinitions
{

    public static function get($lunaDefinitions)
    {
        $wordDefinitions = [];
        $lunaDefinitions
            ->filter('[data-type="word-definitions"]')
            ->each(function ($node) use (&$wordDefinitions) {
                $defs['type'] = ($node->filter('span')->text());

                ($node->filter('ol')->each(function (Crawler $node) use (&$defs) {
                    $defs['def'] = $node->filter('p')->innerText();
                    $defs['example'] = $node->filter('p .luna-example')->innerText();
                }));
                $wordDefinitions[] = ($defs);
            });
        dd($wordDefinitions);

    }

}
