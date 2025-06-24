<?php
namespace WebScrapingApi;

use Illuminate\Support\ServiceProvider;

class WebScrapingApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/webscrapingapi.php', 'webscrapingapi');

        $this->app->singleton(Client::class, function ($app) {
            $apiKey = config('webscrapingapi.api_key');
            return new Client($apiKey);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/webscrapingapi.php' => config_path('webscrapingapi.php'),
        ], 'config');
    }
}