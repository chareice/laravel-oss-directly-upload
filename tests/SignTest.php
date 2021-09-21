<?php
namespace Tests;

use Chareice\OssDirectlyUpload\OssClient;

class SignTest extends TestCase
{
    public function test_sign()
    {
        $accessId = 'test_access_id';
        $accessKey = 'test_access_key';
        $host = 'test_host';
        $bucket = 'test_bucket';

        $ossClient = new OssClient(accessID: $accessId, accessKey: $accessKey,host: $host,bucket: $bucket);
        $signData = $ossClient->sign("user1/test");

        $this->assertEquals($accessId, $signData->accessID);
    }


    public function test_ioc()
    {
        $service = app(OssClient::class);
        $this->assertInstanceOf(OssClient::class, $service);
    }
}