<?php
namespace Chareice\OssDirectlyUpload;

use Carbon\Carbon;

class OssClient
{
    protected int $maxFileSize = 5 * 1024 * 1024;

    // token有效时间 单位: 分钟
    protected int $ttl = 30;

    public function __construct(protected string $accessID, protected string $accessKey, protected string $host, protected string $bucket)
    {

    }

    public function sign(string $dir): SignData
    {
        $policy = base64_encode(json_encode([
            'expiration' => Carbon::now()->addMinutes($this->ttl)->toIso8601ZuluString(),
            'condition' => [
                ['content-length-range', 0, $this->maxFileSize],
                ['starts-with', '$key', $dir]
            ]
        ]));

        return new SignData(
            accessID: $this->accessID,
            host: $this->host,
            policy: $policy,
            signature: base64_encode(hash_hmac('sha1', $policy, $this->accessKey, true)),
            expire: "123",
            dir: $dir,
        );
    }
}