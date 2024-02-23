<?php

namespace App\Core\Event\Domain\DTO;

class EventDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $start,
        public readonly string $end,
        public readonly string $summary
    ){}
}
