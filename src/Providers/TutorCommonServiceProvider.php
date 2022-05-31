<?php

namespace Tutor\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Tutor\Common\Support\HttpClient;
use GuzzleHttp\ClientInterface;

class TutorCommonServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->mergeConfig();
        $this->app->bind(ClientInterface::class, HttpClient::class);
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/tutor_common.php', 'tutor_common');
    }
}
