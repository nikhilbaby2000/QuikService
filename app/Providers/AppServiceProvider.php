<?php

namespace App\Providers;

use Schema;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Validator instance.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $validator;

    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Contracts\Validation\Factory $validator
     * @return void
     */
    public function boot(Validator $validator)
    {
        $this->validator = $validator;

        Schema::defaultStringLength(191);

        $this->loadCustomValidators();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Load the custom validator methods.
     *
     * @return void
     */
    protected function loadCustomValidators()
    {
        $customValidatorClass = 'App\QuikService\Validators\CustomValidators';

        $this->extendValidator('greater_than', $customValidatorClass);
        $this->extendValidator('mobile_number', $customValidatorClass);
        $this->extendValidator('numeric_max', $customValidatorClass);
        $this->extendValidator('numeric_min', $customValidatorClass);
        $this->extendValidator('otp', $customValidatorClass);
        $this->extendValidator('uuid', $customValidatorClass);
        $this->extendValidator('decimal', $customValidatorClass);
    }

    /**
     * Extend the validator with custom methods.
     *
     * @param string $name
     * @param string $class
     * @return void
     */
    protected function extendValidator($name, $class)
    {
        $method = 'validate' . studly_case($name);

        $this->validator->extend($name, "{$class}@{$method}");
    }
}
