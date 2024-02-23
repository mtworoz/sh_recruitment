<?php

namespace App\Core\Event\Domain\DTO;

use DateTime;

class EventDTO
{
    public function __construct(
        public readonly string $id,
        public readonly DateTime $start,
        public readonly DateTime $end,
        public readonly string $summary
    ){}
}
