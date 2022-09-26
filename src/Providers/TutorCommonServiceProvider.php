<?php

namespace Tutor\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Tutor\Common\Middleware\LogRequest;
use Tutor\Common\Support\HttpClient;
use GuzzleHttp\ClientInterface;
use Tutor\Common\Logging\LoggingWithTrace;
use Illuminate\Contracts\Http\Kernel;

class TutorCommonServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->mergeConfig();
        $this->registerLog();
        $this->app->bind(ClientInterface::class, HttpClient::class);
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/tutor_common.php', 'tutor_common');
    }

    private function registerLog(){
        $this->mergeConfigFrom(__DIR__ . '/../../config/tutor_logging.php', 'tutor_logging');

        if(config('tutor_logging.log_with_trace')){
            $channelLogWithTrace = config('tutor_logging.channel_log_with_trace');
            $channelLogWithTrace = explode(',', $channelLogWithTrace);

            foreach ($channelLogWithTrace as $channelLog) {
                config(["logging.channels.$channelLog.tap" => [LoggingWithTrace::class]]);
            }
        }

        if (config('tutor_logging.log_incoming')){
            $kernel = app()->make(Kernel::class);
            $kernel->pushMiddleware(LogRequest::class);
        }

    }
}
