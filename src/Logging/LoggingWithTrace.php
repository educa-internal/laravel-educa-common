<?php

namespace Tutor\Common\Logging;

use Monolog\Formatter\LineFormatter;
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
            if (config('tutor_logging.log_with_milliseconds')) {
                $handler->setFormatter(new LineFormatter(
                    null,
                    "Y-m-d H:i:s.u"
                ));
            }
            $handler->pushProcessor(new IntrospectionProcessor(Logger::DEBUG, ['Illuminate']));
        }
    }
}