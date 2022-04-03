<?php

namespace Repo\Posts\Model\ResourceModel\Post;

use Repo\Posts\Model\ResourceModel\Post;
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
            \Repo\Posts\Model\Blog::class,
            Post::class
        );
    }
}
