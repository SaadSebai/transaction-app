<?php

namespace App\Http\Middlewares;

use Closure;

interface MiddlewareInterface
{
    public function handle(): void;
}