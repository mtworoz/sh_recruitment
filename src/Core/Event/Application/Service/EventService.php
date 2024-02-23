<?php

namespace App\Core\Event\Application\Service;

use App\Common\ICal\Cache\ICalEventFetcherInterface;
use App\Core\Event\Domain\DTO\EventDTO;
use App\Core\Event\Domain\Exception\InvalidDateTimeException;
use DateTime;

class EventService
{
    public function __construct(
        private ICalEventFetcherInterface $iCalEventFetcher,
    ){}

    /**
     * @return EventDTO[]
     */
    public function getEvents(): array
    {
        $url = $_ENV['ICAL_URL'] ?? null;

        if (!$url) {
            throw new \DomainException('ICAL_URL environment variable is not defined.');
        }

        $events = $this->iCalEventFetcher->fetchAndCacheEvents($url);

        return array_map(function ($event) {
            try {

                return new EventDTO(
                    $event['id'],
                    new DateTime($event['start']),
                    new DateTime($event['end']),
                    $event['summary']
                );

            } catch (\Exception $e) {

                throw new InvalidDateTimeException("Invalid datetime format for event with id {$event['id']}");

            }
        }, $events);
    }
}
