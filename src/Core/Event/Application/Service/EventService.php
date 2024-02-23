<?php

namespace App\Core\Event\Application\Service;

use App\Common\ICal\ICalInterface;
use App\Core\Event\Domain\DTO\EventDTO;
use App\Core\Event\Domain\Exception\InvalidDateTimeException;
use DateTime;

class EventService
{

    public function __construct(private ICalInterface $icalService)
    {
    }

    /**
     * @return EventDTO[]
     */
    public function getEvents(): array
    {
        $url = 'https://slowhop.com/icalendar-export/api-v1/21c0ed902d012461d28605cdb2a8b7a2.ics';

        $events = $this->icalService->getEvents($url);

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
