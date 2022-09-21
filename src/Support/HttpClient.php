<?php

namespace Tutor\Common\Support;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Middleware;
use Tutor\Common\Logging\MessageFormatter;

class HttpClient extends Client
{
    public function __construct(array $config = [])
    {
        $config['http_errors'] = config('tutor_common.request_http_errors');
        $config['verify'] = config('tutor_common.request_verify');
        $config['timeout'] = config('tutor_common.request_timeout');

        if (config('tutor_logging.log_outgoing')) {
            $stack = HandlerStack::create();
            $logChannel = app()->get('log');
            $now = getMillisecond();

            $stack->push(
                Middleware::log(
                    $logChannel,
                    new MessageFormatter($now)
                )
            );
            $config['handler'] = $stack;
        }

        parent::__construct($config);
    }
}