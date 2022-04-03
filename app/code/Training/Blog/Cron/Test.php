<?php

namespace Training\Blog\Cron;

use Psr\Log\LoggerInterface;

class Test
{
    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $_logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $this->_logger->debug("testttttt");
    }
}
