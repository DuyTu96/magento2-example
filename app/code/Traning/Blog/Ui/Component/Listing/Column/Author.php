<?php

namespace Training\Blog\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Training\Blog\Api\BlogRepositoryInterface;
use Training\Blog\Api\AdminUserRepositoryInterface;

class Author extends Column
{
    const NAME = 'createdBy';
    const ALT_FIELD = 'author';
    protected $storeManager;
    protected $postRepo;
    protected $adminUser;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     * @param BlogRepositoryInterface $postRepository
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        BlogRepositoryInterface $postRepository,
        AdminUserRepositoryInterface $adminUserRepo,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
        $this->postRepo = $postRepository;
        $this->adminUser = $adminUserRepo;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $arrUserId = [];
            foreach ($dataSource['data']['items'] as & $item) {
                if (!in_array( $item['created_by'], $arrUserId)) $arrUserId[] = $item['created_by'];
            }

            $test = $this->adminUser->getById(1);
        }

        return $dataSource;
    }
}
