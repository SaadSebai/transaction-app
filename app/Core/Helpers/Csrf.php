<?php

namespace App\Core\Helpers;

use Random\RandomException;

class Csrf
{
    /**
     * @throws RandomException
     */
    public static function generate(): string
    {
        if (!isset($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf_token'];
    }

    public static function getToken(): string
    {
        return $_SESSION['_csrf_token'] ?? self::generate();
    }

    public static function verify(?string $token): bool
    {
        return isset($_SESSION['_csrf_token']) && hash_equals($_SESSION['_csrf_token'], $token ?? '');
    }
}