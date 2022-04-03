<?php

namespace Repo\Posts\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CustomSearchResultInterface
 * @package Repo\Post\Api\Data
 */
interface PostSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return PostInterface[]
     */
    public function getItems();

    /**
     * @param PostInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
