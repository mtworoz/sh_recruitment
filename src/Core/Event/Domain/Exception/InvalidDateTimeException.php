<?php

namespace App\Core\Event\Domain\Exception;

use DomainException;

class InvalidDateTimeException extends DomainException
{
    public function __construct(string $message = 'Invalid datetime provided.')
    {
        parent::__construct($message);
    }
}
