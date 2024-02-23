<?php

namespace App\Core\Event\Domain\Exception;

class InvalidDateTimeException extends EventException
{
    public function __construct(string $message = 'Invalid datetime provided.')
    {
        parent::__construct($message);
    }
}
