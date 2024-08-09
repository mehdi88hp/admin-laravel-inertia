<?php

namespace Modules\Components\Admin\Auth\Services;

use Modules\Models\Auth;

class AuthService
{
    public function bulkInsert(string $content)
    {
        $content = str_replace('.', ' ', $content);
        $content = str_replace("\n", ' ', $content);
        $content = str_replace("n't", '', $content);

        $contentArray = explode(' ', $content);

        foreach ($contentArray as $item) {
            $trimed = strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $item));

            Auth::query()->firstOrCreate(['word' => $trimed]);
        }
    }
}
