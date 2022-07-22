<?php

namespace App\Providers;

use League\Flysystem\Filesystem;
use Google\Cloud\Storage\StorageClient;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;
use Illuminate\Support\ServiceProvider;

class GoogleStorageServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // \Storage::extend('gcs',function($app, $config){
        //     $storageClient = new StorageClient([
        //         'projectId' => $config['project_id'],
        //         'keyFilePath' => 'key_file'
        //     ]);
        //     $bucket = $storageClient->bucket($config['bucket']);
        //     $adapter = new GoogleStorageAdapter ($storageClient, $bucket);
        //     return new Filesystem($adapter);
        // });
    }
}
