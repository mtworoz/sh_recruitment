<?php

namespace App\Common\ICal;

use App\Common\ICal\Validator\ICSFileChecker;
use App\Common\ICal\Validator\URLValidator;
use ICal\ICal;

class ICalService implements ICalInterface
{
    public function __construct(
        private URLValidator $urlValidator,
        private ICSFileChecker $icsFileChecker,
    ){}

    public function getEvents(string $url): array
    {
        $this->urlValidator->validate($url);
        $this->icsFileChecker->validate($url);

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
