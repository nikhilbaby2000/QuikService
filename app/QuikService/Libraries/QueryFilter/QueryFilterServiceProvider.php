<?php

namespace App\QuikService\Libraries\QueryFilter;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class QueryFilterServiceProvider extends ServiceProvider
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
        $this->app->bind('query-filter', QueryFilter::class);

        $this->app->alias('query-filter', QueryFilterContract::class);
    }

    /**
     * Register the facade without the user having to add it to the app.php file.
     */
    protected function registerFacade()
    {
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('QueryFilter', QueryFilterFacade::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['query-filter', QueryFilterContract::class];
    }
}
