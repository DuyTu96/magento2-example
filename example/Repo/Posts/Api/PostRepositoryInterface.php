<?php

namespace Repo\Posts\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Repo\Posts\Api\Data\PostInterface;
use Repo\Posts\Api\Data\PostSearchResultInterface;

/**
 * Interface CustomManagementInterface
 * @package Repo\Posts\Api
 */
interface PostRepositoryInterface
{
    /**
     * @param int $id
     * @return PostInterface
     */
    public function getById(int $id);

    /**
     * @param PostInterface $vimagento
     * @return PostInterface
     */
    public function save(PostInterface $vimagento);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return PostSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
