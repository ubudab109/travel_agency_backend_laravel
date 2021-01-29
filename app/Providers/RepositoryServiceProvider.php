<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\Destination\DestinationRepositoryInterface::class, \App\Repositories\Destination\DestinationRepository::class);
        $this->app->bind(\App\Repositories\Service\ServiceRepositoryInterface::class, \App\Repositories\Service\ServiceRepository::class);
        $this->app->bind(\App\Repositories\Payment\PaymentInterface::class, \App\Repositories\Payment\PaymentRepository::class);

        //:end-bindings:
    }
}
