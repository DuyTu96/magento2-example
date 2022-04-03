<?php

namespace Training\Blog\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Training\Blog\Api\Data\BlogInterface;
use Training\Blog\Api\Data\BlogSearchResultInterface;

/**
 * Interface CustomManagementInterface
 * @package Training\Blog\Api
 */
interface BlogRepositoryInterface
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
