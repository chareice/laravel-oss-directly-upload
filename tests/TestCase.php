<?php


namespace Tests;


use Chareice\OssDirectlyUpload\OssDirectlyUploadServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [OssDirectlyUploadServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('oss', [
            'access_id' => 'test',
            'access_key' => 'key',
            'host' => 'host',
            'bucket' => 'bucket'
        ]);
    }
}