<?php

namespace Tudd\Todo\Block\Adminhtml\Task\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function getModelId()
    {
        return $this->context->getRequest()->getParam('task_id');
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
