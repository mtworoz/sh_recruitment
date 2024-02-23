<?php

namespace App\Common\ICal;

interface ICalInterface
{
    public function getEvents(string $url): array;
}
