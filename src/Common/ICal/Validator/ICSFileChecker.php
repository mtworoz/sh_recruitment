<?php

namespace App\Common\ICal\Validator;

use App\Common\ICal\Exception\InvalidICSFileException;

class ICSFileChecker implements ValidatorInterface
{
    public function validate(string $url): void
    {
        $extension = strtolower(pathinfo($url, PATHINFO_EXTENSION));
        if ($extension !== 'ics') {
            throw new InvalidICSFileException('The provided URL does not point to an ICS file: ' . $url);
        }
    }
}
