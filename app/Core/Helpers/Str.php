<?php

namespace App\Core\Helpers;

class Str
{
    public static function toCamelCase(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
    }
    public static function uppercase(string $string): string
    {
        return strtoupper($string);
    }
}