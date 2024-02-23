<?php

namespace App\Core\Event\Application\Service;

use App\Core\Event\Domain\DTO\EventDTO;
use App\Core\Event\Domain\Exception\InvalidDateTimeException;
use InvalidArgumentException;

interface EventServiceInterface
{
    /**
     * @return EventDTO[] Returns array of EventDTO objects
     *
     * @throws InvalidDateTimeException
     * @throws InvalidArgumentException
     */
    public function getEvents(): array;
}

