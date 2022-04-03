<?php

namespace Repo\Posts\Model;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Repo\Posts\Api\Data\PostInterface;
use Repo\Posts\Model\ResourceModel\Post\Collection;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Repo\Posts\Api\PostRepositoryInterface;
use Repo\Posts\Model\ResourceModel\Post;
use Repo\Posts\Model\ResourceModel\Post\CollectionFactory;
use Repo\Posts\Api\Data\PostSearchResultInterfaceFactory;

/**
 * Class PostManagement
 * @package Repo\Posts\Model
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * @var ResourceModel\Post
     */
    protected $postResource;

    /**
     * @var ResourceModel\Post\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var PostSearchResultInterfaceFactory
     */
    protected $searchResultInterfaceFactory;
    private $customFactory;
    private $customResource;

    /**
     * PostRepository constructor.
     * @param PostFactory $postFactory
     * @param ResourceModel\Post $postResource
     * @param ResourceModel\Post\CollectionFactory $collectionFactory
     * @param PostSearchResultInterfaceFactory $searchResultInterfaceFactory
     */
    public function __construct(
        PostFactory $postFactory,
        Post $postResource,
        CollectionFactory $collectionFactory,
        PostSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->customFactory = $postFactory;
        $this->customResource = $postResource;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     * @throws NoSuchEntityException
     */
    public function getById(int $id)
    {
        $customModel = $this->customFactory->create();
        $this->customResource->load($customModel, $id);
        if (!$customModel->getEntityId()) {
            throw new NoSuchEntityException(__('Unable to find custom data with ID "%1"', $id));
        }
        return $customModel;
    }

    /**
     * {@inheritdoc}
     * @throws AlreadyExistsException
     */
    public function save(PostInterface $vimagento)
    {
        $this->customResource->save($vimagento);
        return $vimagento;
    }

    /**
     * {@inheritdoc}
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id)
    {
        try {
            $customModel = $this->customFactory->create();
            $this->customResource->load($customModel, $id);
            $this->customResource->delete($customModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return mixed
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultInterfaceFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }
}
