<?php

namespace App\Common\S3Uploader\Exception;

use Psr\Log\LoggerInterface;

class S3UploaderException extends \RuntimeException
{
    public function __construct($message, LoggerInterface $logger)
    {
        parent::__construct($message);

        $logger->error($message);
    }
}

