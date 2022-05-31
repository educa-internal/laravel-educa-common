<?php

namespace Tutor\Common\Support;

use GuzzleHttp\Client;

class HttpClient extends Client
{
    public function __construct(array $config = [])
    {
        $config['http_errors'] = config('tutor_common.request_http_errors');
        $config['verify'] = config('tutor_common.request_verify');
        $config['timeout'] = config('tutor_common.request_timeout');

        parent::__construct($config);
    }
}