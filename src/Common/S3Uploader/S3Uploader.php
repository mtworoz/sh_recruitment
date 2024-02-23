<?php

namespace App\Common\S3Uploader;

use App\Common\S3Uploader\Exception\S3UploaderException;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use Psr\Log\LoggerInterface;

class S3Uploader implements S3UploaderInterface
{
    private S3Client $s3Client;

    public function __construct(private LoggerInterface $logger)
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
        try {
            $this->s3Client->putObject([
                'Bucket' => $_ENV['AWS_BUCKET_NAME'],
                'Key' => $key,
                'SourceFile' => $filePath,
            ]);
        } catch (S3Exception $e) {

            $errorMessage = "An error occurred while uploading the file to Amazon S3: " . $e->getMessage();
            $this->logger->error($errorMessage);
            throw new S3UploaderException($errorMessage, $this->logger);

        } catch (\Exception $e) {

            $errorMessage = "An unexpected error occurred: " . $e->getMessage();
            $this->logger->error($errorMessage);
            throw new S3UploaderException($errorMessage, $this->logger);

        }
    }
}

