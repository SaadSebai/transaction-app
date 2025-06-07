<?php

namespace App\Http\Middlewares;

use App\Core\Helpers\ResponseStatus;
use App\Core\Session;

class Throttle implements MiddlewareInterface
{
    const int LIMIT = 1000;
    const int SECONDS = 60;

    public function handle(): void
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $key = 'throttle_' . md5($ip);

        $requests = Session::get($key, []);
        $now = time();

        $requests = array_filter($requests, fn($timestamp) => $timestamp >= $now - static::SECONDS);

        if (count($requests) >= static::LIMIT) abort(ResponseStatus::UNAUTHORIZED);

        $requests[] = $now;
        Session::put($key, $requests);
    }
}