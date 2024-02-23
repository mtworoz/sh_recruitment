<?php

namespace App\Core\Event\Application\Service;

use App\Common\ICal\Cache\ICalEventFetcherInterface;
use App\Core\Event\Domain\DTO\EventDTO;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use App\Core\Event\Domain\Event\EventsFetchedEvent;
use App\Core\Event\Domain\Exception\InvalidDateTimeException;
use DateTime;

class EventService
{
    public function __construct(
        private ICalEventFetcherInterface $iCalEventFetcher,
        private EventDispatcherInterface $eventDispatcher
    ){}

    /**
     * @return EventDTO[]
     */
    public function getEvents(): array
    {
        $url = $_ENV['ICAL_URL'] ?? null;

        if (!$url) {
            throw new \InvalidArgumentException('ICAL_URL environment variable is not defined.');
        }

        $events = $this->iCalEventFetcher->fetchAndCacheEvents($url);

        $this->eventDispatcher->dispatch(new EventsFetchedEvent($events));

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
