<?php

namespace App\Core;

class Config
{
    public function __construct(protected array $configs)
    {
        //
    }

    public function getConfig(string $key): mixed
    {
        return $this->configs[$key] ?? null;
    }
}