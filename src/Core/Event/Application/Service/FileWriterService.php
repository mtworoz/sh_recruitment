<?php

namespace App\Core\Event\Application\Service;

use App\Common\S3Uploader\S3Uploader;
use Symfony\Component\Filesystem\Filesystem;

class FileWriterService
{
    public function __construct(
        private S3Uploader $s3Uploader,
        private Filesystem $filesystem)
    {}

    public function writeToFilePath(string $fileName, string $data): void
    {
        $directory = 'ics';

        $this->filesystem->mkdir($directory, 0777);

        $filePath = $directory.'/'.$fileName;

        $this->filesystem->dumpFile($filePath, $data);

        $this->s3Uploader->uploadFile($fileName, $filePath);

        $this->filesystem->remove($filePath);
    }
}
