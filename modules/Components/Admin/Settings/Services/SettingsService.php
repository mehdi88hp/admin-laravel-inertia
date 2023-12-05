<?php

namespace Modules\Components\Admin\Setting\Services;

use Modules\Models\Setting;

class SettingsService
{
    public function bulkInsert(string $content)
    {
        $content = str_replace('.', ' ', $content);
        $content = str_replace("\n", ' ', $content);
        $content = str_replace("n't", '', $content);

        $contentArray = explode(' ', $content);

        foreach ($contentArray as $item) {
            $trimed = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $item));

            Setting::query()->firstOrCreate(['Setting' => $trimed]);
        }
    }
}
