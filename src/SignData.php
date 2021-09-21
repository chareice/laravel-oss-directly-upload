<?php
namespace Chareice\OssDirectlyUpload;


class SignData
{
    public function __construct(
        public string $accessID,
        public string $host,
        public string $policy,
        public string $signature,
        public string $expire,
        public string $dir,
        public ?string $callback = null,
    )
    {
    }
}