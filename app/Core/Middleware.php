<?php

namespace App\Core;

use Exception;

class Middleware
{
    /**
     * @throws Exception
     */
    public static function resolve(?string $key, string $group = 'route'): void
    {
        $middlewares = require base_path('config/middlewares.php');

        $middleware = $middlewares[$group][$key] ?? false;

        if (!$middleware) {
            throw new Exception("No matching middleware found for key '{$key}'.");
        }

        (new $middleware)->handle();
    }
}