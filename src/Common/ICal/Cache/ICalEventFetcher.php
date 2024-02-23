<?php

namespace App\Common\ICal\Cache;

use App\Common\Cache\CacheServiceInterface;
use App\Common\ICal\ICalInterface;

class ICalEventFetcher implements ICalEventFetcherInterface
{
    public function __construct(
        private ICalInterface $iCalService,
        private CacheServiceInterface $cacheService
    ){}

    public function fetchAndCacheEvents(string $url): array
    {
        $cacheKey = md5($url);

        $cachedEvents = $this->cacheService->get($cacheKey);

        if ($cachedEvents !== null) {
            return $cachedEvents;
        }

        $fetchedEvents = $this->iCalService->getEvents($url);
        $this->cacheService->save($cacheKey, $fetchedEvents);

        return $fetchedEvents;
    }
}
