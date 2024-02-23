<?php

namespace App\Common\ICal\Cache;

interface ICalEventFetcherInterface
{
    public function fetchAndCacheEvents(string $url): array;
}
