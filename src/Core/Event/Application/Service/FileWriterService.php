<?php

namespace App\Core\Event\Application\Service;

use App\Common\S3Uploader\S3Uploader;
use App\Core\Event\Application\Service\Exception\FileWriterException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Psr\Log\LoggerInterface;

class FileWriterService
{
    public function __construct(
        private S3Uploader $s3Uploader,
        private Filesystem $filesystem,
        private LoggerInterface $logger
    ) {}

    public function writeToFilePath(string $fileName, string $data): void
    {
        $directory = 'ics';

        try {
            $this->filesystem->mkdir($directory, 0777);

            $filePath = $directory.'/'.$fileName;

            $this->filesystem->dumpFile($filePath, $data);

            $this->s3Uploader->uploadFile($fileName, $filePath);

            $this->filesystem->remove($filePath);

        } catch (IOExceptionInterface $e) {

            throw new FileWriterException(
                "An error occurred while performing file operations: " . $e->getMessage(), $this->logger);

        } catch (\Exception $e) {

            throw new FileWriterException("An unexpected error occurred: " . $e->getMessage(), $this->logger);
        }

    }
}
