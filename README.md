# Laravel OSS Directly Upload

阿里云 OSS 直传签名计算

## 使用
```bash
composer require chareice/laravel-oss-directly-upload
```

## 配置
```bash
php artisan vendor:publish --provider="Chareice\\OssDirectlyUpload\\OssDirectlyUploadServiceProvider" --tag=config
```

## 使用
```php
$service = app(OssClient::class);
/** @var \Chareice\OssDirectlyUpload\SignData $signResult */
$signResult = $service->sign("user/dir1")
```
