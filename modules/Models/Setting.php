<?php

namespace Modules\Models;

use Kaban\General\Services\LastSettings;

class Setting extends \anlutro\LaravelSettings\Facades\Setting
{
    /*    public static function cacheGet($key, $default = null)
        {
            $values = cache()->remember($key, null, function () use ($key, $default) {
                return Setting::get($key, $default);
            });
            return $values;
        }*/
}
