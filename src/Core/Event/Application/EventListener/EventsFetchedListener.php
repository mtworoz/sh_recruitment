<?php

namespace App\Core\Event\Application\EventListener;

use App\Core\Event\Application\Service\FileWriterService;
use App\Core\Event\Domain\Event\EventsFetchedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class EventsFetchedListener
{
    public function __construct(private FileWriterService $fileWriterService)
    {}

    public function __invoke(EventsFetchedEvent $event)
    {
        $serializedData = $event->getSerializedData();

        $timestamp = time();
        $fileName = 'events_' . $timestamp . '.json';

        $this->fileWriterService->writeToFilePath($fileName, $serializedData);
    }
}
