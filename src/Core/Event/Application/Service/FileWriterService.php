<?php

namespace App\Core\Event\Application\Service;

class FileWriterService
{
    public function writeToFilePath(string $fileName, string $data): void
    {
        $directory = 'ics';
        if (!file_exists($directory) && !is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filePath = $directory.'/'.$fileName;

        file_put_contents($filePath, $data);
    }
}
