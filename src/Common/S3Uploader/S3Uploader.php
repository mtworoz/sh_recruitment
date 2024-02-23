<?php

namespace App\Common\S3Uploader;

use Aws\S3\S3Client;

class S3Uploader
{
    private S3Client $s3Client;

    public function __construct()
    {
        $this->s3Client = new S3Client([
            'version' => 'latest',
            'region' => $_ENV['AWS_S3_REGION'],
            'credentials' => [
                'key' => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ],
        ]);
    }

    public function uploadFile(string $key, string $filePath): void
    {
        $this->s3Client->putObject([
            'Bucket' => $_ENV['AWS_BUCKET_NAME'],
            'Key' => $key,
            'SourceFile' => $filePath,
        ]);

    }
}

