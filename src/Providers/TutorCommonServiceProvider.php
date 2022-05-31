<?php

namespace Tutor\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Tutor\Common\Support\HttpClient;
use GuzzleHttp\ClientInterface;

class TutorCommonServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind(ClientInterface::class, HttpClient::class);
    }

    public function register()
    {
        $this->mergeConfig();
    }

    private function mergeConfig()
    {
//        $this->mergeConfigFrom(__DIR__ . '/../../config/services.php', 'services');
    }
}
