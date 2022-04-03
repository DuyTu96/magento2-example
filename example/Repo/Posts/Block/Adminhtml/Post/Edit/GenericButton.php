<?php

namespace Repo\Posts\Block\Adminhtml\Post\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{
    protected $context;

    /**
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * Return model ID
     *
     * @return int|null
     */
    public function getModelId()
    {
        return $this->context->getRequest()->getParam('task_id');
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
