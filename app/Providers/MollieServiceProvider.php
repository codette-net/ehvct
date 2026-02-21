<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mollie\Api\MollieApiClient;

class MollieServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MollieApiClient::class, function () {
            return new MollieApiClient();
        });
    }
}
