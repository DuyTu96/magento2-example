<?php

namespace Training\Blog\Model\ResourceModel\Blog;

use Training\Blog\Model\ResourceModel\Blog;
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
            \Training\Blog\Model\Blog::class,
            Blog::class
        );
    }
}
