<?php

namespace App\Core\Event\UserInterface\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use ICal\ICal;

class EventController extends AbstractController
{

    #[Route(path: "/events", name: "get_events", methods: ["GET"])]
    public function getEvents(Request $request): JsonResponse
    {
        $url = 'https://slowhop.com/icalendar-export/api-v1/21c0ed902d012461d28605cdb2a8b7a2.ics';
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

        return new JsonResponse($events);
    }

}
