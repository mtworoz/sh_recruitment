<?php

namespace App\Core\Event\UserInterface\Controller;

use App\Core\Event\Application\Service\EventService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

class EventController extends AbstractController
{
    public function __construct(
        private EventService $eventService,
        private SerializerInterface $serializer
    ){}

    #[Route(path: "/events", name: "get_events", methods: ["GET"])]
    public function getEvents(Request $request): JsonResponse
    {
        try {

            $events = $this->eventService->getEvents();
            $serializedEvents = $this->serializer->serialize($events, 'json');
            return new JsonResponse($serializedEvents, 200, [], true);

        } catch (\Exception $e) {

            return new JsonResponse(['error' => $e->getMessage()], 400);

        }
    }
}
