<?php

namespace App\Common\S3Uploader;

interface S3UploaderInterface
{
    public function uploadFile(string $key, string $filePath): void;
}
