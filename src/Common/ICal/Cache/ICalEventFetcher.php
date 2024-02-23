<?php

namespace App\Common\ICal\Cache;


use App\Common\Cache\CacheService;
use App\Common\ICal\ICalInterface;
use Psr\Cache\InvalidArgumentException;

class ICalEventFetcher implements ICalEventFetcherInterface
{
    public function __construct(
        private ICalInterface $iCalService,
        private CacheService $cacheService
    ){}

    /**
     * @throws InvalidArgumentException
     */
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
