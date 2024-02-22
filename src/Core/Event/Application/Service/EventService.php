<?php

namespace App\Core\Event\Application\Service;

use App\Common\ICal\ICalService;

class EventService
{

    public function __construct(private ICalService $icalService)
    {
    }

    public function getEvents(): array
    {
        $url = 'https://slowhop.com/icalendar-export/api-v1/21c0ed902d012461d28605cdb2a8b7a2.ics';
        return $this->icalService->getEvents($url);
    }
}
