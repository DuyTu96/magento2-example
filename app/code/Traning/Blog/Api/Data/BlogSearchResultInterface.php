<?php

namespace Training\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface CustomSearchResultInterface
 * @package Repo\Blog\Api\Data
 */
interface BlogSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return BlogInterface[]
     */
    public function getItems();

    /**
     * @param BlogInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
