<?php

namespace App\QuikService\Services\OTP;

use Illuminate\Support\ServiceProvider;
use App\QuikService\Services\OTP\Generator\OTPGenerator;
use App\QuikService\Services\OTP\Handler\DatabaseOTPHandler;
use App\QuikService\Services\OTP\Handler\OTPHandlerContract;
use App\QuikService\Services\OTP\Generator\OTPGeneratorContract;

class OTPFunctionalityServiceProvider extends ServiceProvider
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
        $this->app->singleton(OTPGeneratorContract::class, OTPGenerator::class);
        $this->app->singleton(OTPHandlerContract::class, DatabaseOTPHandler::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [OTPGeneratorContract::class, OTPHandlerContract::class];
    }
}
