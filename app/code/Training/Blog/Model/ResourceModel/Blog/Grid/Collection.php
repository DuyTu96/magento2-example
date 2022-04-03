<?php

namespace Training\Blog\Model\ResourceModel\Blog\Grid;

use Psr\Log\LoggerInterface;
use Magento\Framework\Event\ManagerIphnterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Training\Blog\Model\ResourceModel\Blog\Collection as GridCollection;

class Collection extends GridCollection implements SearchResultInterface
{
    /**
     * Resource initialization
     * @param EntityFactoryInterface $entityFactory ,
     * @param LoggerInterface $logger ,
     * @param FetchStrategyInterface $fetchStrategy ,
     * @param ManagerInterface $eventManager ,
     * @param StoreManagerInterface $storeManager ,
     * @param String $mainTable ,
     * @param String $eventPrefix ,
     * @param String $eventObject ,
     * @param String $resourceModel ,
     * @param string $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
     * @param null $connection = null,
     * @param AbstractDb|null $resource = null
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
                               $mainTable,
                               $eventPrefix,
                               $eventObject,
                               $resourceModel,
                               $model = 'Magento\Framework\View\Element\UiComponent\DataProvider\Document',
                               $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $storeManager,
            $connection,
            $resource
        );
        $this->_eventPrefix = $eventPrefix;
        $this->_eventObject = $eventObject;
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
    }

    /**
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * @param AggregationInterface $aggregations
     *
     * @return void
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get search criteria.
     *
     * @return SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria.
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(
        SearchCriteriaInterface $searchCriteria = null
    ) {
        return $this;
    }

    /**
     * Get total count.
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count.
     *
     * @param int $totalCount
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items list.
     *
     * @param ExtensibleDataInterface[] $items
     *
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
