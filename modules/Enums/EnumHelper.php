<?php

namespace Modules\Enums;

trait EnumHelper
{
    public function title($prefix = null)
    {
        $prefix = $prefix ?? ('enums.' . static::class . '.');

        return trans($prefix . $this->name);
    }

    public function toArray()
    {
        return [
            'key' => $this->name,
            'value' => $this->value,
            'title' => $this->title(),
        ];
    }

    public static function options()
    {
        return array_map(fn ($case) => $case->toArray(), static::cases());
    }
}
