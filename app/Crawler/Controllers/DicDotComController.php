<?php

namespace App\Crawler\Controllers;

use App\Crawler\Services\DicDotCom\Main;
use Modules\Models\DicDotComRaw;
use Symfony\Component\DomCrawler\Crawler;

class DicDotComController
{
    public function preview($id)
    {
        return DicDotComRaw::query()->find($id)->raw;
    }

    public function process($id)
    {
        (new Main)->process($id);
    }
}
