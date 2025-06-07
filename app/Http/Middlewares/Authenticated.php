<?php

namespace App\Http\Middlewares;

use App\Core\Helpers\ResponseStatus;
use App\Core\Session;

class Authenticated implements MiddlewareInterface
{
    public function handle(): void
    {
        if (!Session::has('user')) abort(ResponseStatus::UNAUTHORIZED);
    }
}