<?php

namespace App\Providers;

use App\Services\OandaApi;
use App\Services\RabbitMqService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // register a singleton instance of our oanda api interfce
        // this can be changed to a bind instance later on if required
        $this->app->bind(OandaApi::class, function () {
            return new OandaApi(env('OANDA_API_KEY'));
        });

        $this->app->bind(RabbitMqService::class, function () {
            return new RabbitMqService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
