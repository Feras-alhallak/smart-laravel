<?php

namespace Ferasalhallak\SmartLaravel\Helpers;

use Aws\S3\S3Client;

class S3Helper
{

    protected $s3;
    protected $bucket;
    private static $instance = null;

    private function __construct()
    {
        $this->s3 = new S3Client([
            'version' => 'latest',
            'region'  => env('AWS_DEFAULT_REGION'),
            'credentials' => [
                'key'    => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
        $this->bucket = env('AWS_BUCKET');
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new S3Helper();
        }

        return self::$instance;
    }

    public function copy($sourceKeyname, $distKeyname)
    {
        try {
            $this->s3->copyObject([
                'Bucket'     => $this->bucket,
                'Key'        => "{$distKeyname}",
                'CopySource' => urlencode($this->bucket . '/' . $sourceKeyname),
                'ACL'          => 'public-read',
            ]);

            return $distKeyname;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
