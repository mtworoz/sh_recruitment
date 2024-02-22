<?php

namespace App\Core\Event\UserInterface\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{

    #[Route(path: "/events", name: "get_events", methods: ["GET"])]
    public function getEvents(Request $request): JsonResponse
    {

        return new JsonResponse(json_encode('ok'));
    }

}
