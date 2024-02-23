<?php

namespace App\Common\ICal\Validator;

interface ValidatorInterface
{
    public function validate(string $url): void;
}
