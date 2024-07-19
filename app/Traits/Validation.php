<?php

namespace App\Traits;

trait Validation
{
    public function isExist($key, $payload): bool
    {
        return (key_exists($key, $payload) || array_key_exists($key, $payload)) && !empty($payload[$key]);
    }
}