<?php

namespace App\Enums\Concerns;

trait EnumsToArray
{
    /**
     * @throws \Exception
     */
    public static function toArray(): array
    {
        $enums = static::cases();

        return array_map(function ($enum) {
            return $enum->value;
        }, $enums);
    }
}
