<?php

namespace Tudd\Todo\Controller\Adminhtml\Task;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Data\Form\Element\CollectionFactory;
use Magento\Framework\View\Result\PageFactory;

class Create extends Action
{
    protected $resultPageFactory;
    protected $_productCollectionFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CollectionFactory $productCollectionFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
//        $resultPage = $this->resultPageFactory->create();
//        $resultPage->getConfig()->getTitle()->prepend(__("TuDD Create Task"));

        $collection = $this->_productCollectionFactory->create();


        dd($collection);

//        return $resultPage;
    }
}
