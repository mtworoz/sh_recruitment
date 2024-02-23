<?php

namespace App\Common\Cache;

use Psr\Cache\InvalidArgumentException;

interface CacheServiceInterface
{

    public function save(string $key, mixed $value, int $expiration = null): void;

    public function get(string $key);

}
