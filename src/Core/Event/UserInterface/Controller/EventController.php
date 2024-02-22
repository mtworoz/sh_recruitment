<?php

namespace App\Core\Event\UserInterface\Controller;

use App\Core\Event\Application\Service\EventService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    public function __construct(private EventService $eventService)
    {
    }

    #[Route(path: "/events", name: "get_events", methods: ["GET"])]
    public function getEvents(Request $request): JsonResponse
    {
        $events = $this->eventService->getEvents();
        return new JsonResponse($events);
    }

}
