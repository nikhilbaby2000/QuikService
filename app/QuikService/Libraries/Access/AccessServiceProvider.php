<?php

namespace App\QuikService\Libraries\Access;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AccessServiceProvider extends ServiceProvider
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
        $this->app->singleton('access', Access::class);
    }

    /**
     * Register the facade without the user having to add it to the app.php file.
     */
    protected function registerFacade()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Access', AccessFacade::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['access'];
    }
}
