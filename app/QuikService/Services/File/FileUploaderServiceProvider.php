<?php

namespace App\QuikService\Services\File;

use Illuminate\Support\ServiceProvider;

class FileUploaderServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(FileUploaderContract::class, FileUploader::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [FileUploaderContract::class];
    }
}
