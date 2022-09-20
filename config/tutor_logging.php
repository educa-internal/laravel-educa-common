<?php

return [
    'log_with_trace' => env('TUTOR_LOGGING_LOG_WITH_TRACE', true),
    'channel_log_with_trace' => env('TUTOR_LOGGING_CHANNEL_LOG_WITH_TRACE', 'kafka,daily'),
    'log_incoming' => env('TUTOR_LOGGING_LOG_INCOMING', true),
    'log_outgoing' => env('TUTOR_LOGGING_LOG_OUTGOING', true)
];
