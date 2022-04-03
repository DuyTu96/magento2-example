<?php

namespace Training\Blog\Model\Queue;

use Psr\Log\LoggerInterface;

class Consumer
{
    protected LoggerInterface $_logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    /**
     * @param $data
     */
    public function process($data)
    {
        dd($data);
        $this->_logger->debug("testttttt");
    }
}
