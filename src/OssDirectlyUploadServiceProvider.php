<?php


namespace Chareice\OssDirectlyUpload;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class OssDirectlyUploadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . "/../config/oss.php", 'oss');
    }

    public function register()
    {
        $this->app->bind(OssClient::class, function (Application $app) {
            return new OssClient(
                accessID: $app['config']['oss.access_id'],
                accessKey: $app['config']['oss.access_key'],
                host: $app['config']['oss.host'],
                bucket: $app['config']['oss.bucket']
            );
        });
    }
}