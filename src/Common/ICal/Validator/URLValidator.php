<?php

namespace App\Common\ICal\Validator;

use App\Common\ICal\Exception\InvalidURLException;

class URLValidator implements ValidatorInterface
{
    public function validate(string $url): void
    {
        if (!$this->isAccessible($url)) {
            throw new InvalidURLException('The provided URL is not accessible or does not exist: ' . $url);
        }
    }

    private function isAccessible(string $url): bool
    {
        $headers = @get_headers($url);
        return $headers !== false && !str_contains($headers[0], '404');
    }
}
