<?php

namespace App\QuikService\Libraries\SMS;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
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
        $this->registerBinding();

        $this->registerFacade();
    }

    /**
     * Register the application bindings.
     */
    protected function registerBinding()
    {
        $this->app->bind('sms', SMS::class);

        $this->app->alias('sms', SMSContract::class);
    }

    /**
     * Register the facade without the user having to add it to the app.php file.
     */
    protected function registerFacade()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('SMS', SMSFacade::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sms', SMSContract::class];
    }
}
