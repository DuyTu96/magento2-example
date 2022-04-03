<?php

namespace Tudd\Todo\Block\Adminhtml\Task\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tudd\Todo\Block\Adminhtml\Task\Edit\GenericButton;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        $data = [];
        if ($this->getModelId()) {
            $data = [
                'label' => __('Delete Task'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['task_id' => $this->getModelId()]);
    }
}
