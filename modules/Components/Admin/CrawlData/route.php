<?php


\Route::group(['prefix' => '/cr/dic.com/'], function () {
    \Route::any('get-pages', [\Modules\Components\Admin\CrawlData\Controllers\DictionaryDotComController::class, 'getPages']);
});
