<?php

namespace App\Core\Event\Application\Service\Exception;
use Psr\Log\LoggerInterface;

class FileWriterException extends \RuntimeException
{
    public function __construct($message, LoggerInterface $logger)
    {
        parent::__construct($message);

        $logger->error($message);
    }
}
