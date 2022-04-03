<?php

namespace Tudd\Todo\Model\ResourceModel\Task;

use Tudd\Todo\Model\ResourceModel\Task;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Tudd\Todo\Model\Task::class,
            Task::class
        );
    }
}
