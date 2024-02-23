<?php

namespace App\Common\ICal;

use ICal\ICal;

class ICalService
{
    public function getEvents(string $url): array
    {
        $ical = new ICal($url);

        $events = [];

        foreach ($ical->events() as $event) {
            $events[] = [
                'id' => $event->uid,
                'start' => $event->dtstart,
                'end' => $event->dtend,
                'summary' => $event->summary,
            ];
        }

        return $events;
    }
}
