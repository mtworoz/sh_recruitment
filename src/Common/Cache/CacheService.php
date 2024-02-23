<?php

namespace App\Common\Cache;

use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class CacheService
{
    private $cache;

    public function __construct()
    {
        $this->cache = new FilesystemAdapter();
    }

    /**
     * @throws InvalidArgumentException
     */
    public function save(string $key, $value, int $expiration = null): void
    {
        $cacheItem = $this->cache->getItem($key);
        $cacheItem->set($value);

        if ($expiration !== null) {
            $cacheItem->expiresAfter($expiration);
        }

        $this->cache->save($cacheItem);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function get(string $key)
    {
        $cacheItem = $this->cache->getItem($key);

        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        return null;
    }
}
