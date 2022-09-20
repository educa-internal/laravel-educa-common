<?php

namespace Tutor\Common\Logging;

use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;

class LoggingWithTrace
{
    /**
     * Customize the given logger instance.
     *
     * @param \Illuminate\Log\Logger $logger
     * @return void
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->pushProcessor(new IntrospectionProcessor(Logger::DEBUG, ['Illuminate']));
        }
    }
}