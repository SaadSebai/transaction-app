<?php

use App\Http\Middlewares\Authenticated;
use App\Http\Middlewares\Guest;
use App\Http\Middlewares\Throttle;

return [
    'route' => [
        'guest' => Guest::class,
        'auth' => Authenticated::class
    ],
    'global' => [
        'throttle' => Throttle::class,
    ],
];