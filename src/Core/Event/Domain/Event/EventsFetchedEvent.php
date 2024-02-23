<?php

namespace App\Core\Event\Domain\Event;

use Symfony\Contracts\EventDispatcher\Event;

class EventsFetchedEvent extends Event
{
    public function __construct(
        private array $data
    ){}

    public function getSerializedData(): string
    {
        return json_encode($this->data);
    }
}
