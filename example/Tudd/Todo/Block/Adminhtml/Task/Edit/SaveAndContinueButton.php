<?php

namespace Tudd\Todo\Block\Adminhtml\Task\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tudd\Todo\Block\Adminhtml\Task\Edit\GenericButton;

class SaveAndContinueButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => [
                        'event' => 'saveAndContinueEdit'
                    ],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
