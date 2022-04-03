<?php

namespace Repo\Posts\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Repo\Posts\Api\Data\BlogInterface;
use Repo\Posts\Api\Data\BlogSearchResultInterface;

/**
 * Interface CustomManagementInterface
 * @package Repo\Posts\Api
 */
interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return BlogInterface
     */
    public function getById(int $id);

    /**
     * @param BlogInterface $vimagento
     * @return BlogInterface
     */
    public function save(BlogInterface $vimagento);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return BlogSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
