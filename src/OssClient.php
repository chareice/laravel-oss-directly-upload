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
        $expiration = Carbon::now()->addMinutes($this->ttl)->toIso8601String();


        /**
         * Policy 规则
         * https://help.aliyun.com/document_detail/31988.html?spm=a2c4g.11186623.0.0.51e0774fwazjir#title-5go-s2f-dnw
         */
        $policy = base64_encode(json_encode([
            'expiration' => $expiration,
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
            expire: $expiration,
            dir: $dir,
        );
    }
}