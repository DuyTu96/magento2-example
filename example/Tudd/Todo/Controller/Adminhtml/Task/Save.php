<?php

namespace Tudd\Todo\Controller\Adminhtml\Task;

use Exception;
use Tudd\Todo\Model\Task;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends Action
{
    const EVENT_NAME = 'tudd_todo_controller_adminhtml_task_save';

    protected $dataPersistor;

    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();
        
        if ($data['general']) {
            $id = $this->getRequest()->getParam('task_id');
            $model = $this->_objectManager->create(Task::class)->load($id);

            if (isset($id)) {
                $model->setId($id);
                $model->setData($data['general']);
                $model->save();
                dd($model);
            } else {
                if (!$model->getId() && $id) {
                    $this->messageManager->addErrorMessage(__('This Task no longer exists.'));

                    return $resultRedirect->setPath('*/*/');
                }

                $model->setData($data['general']);

                try {
                    $model->save();
                    $this->messageManager->addSuccessMessage(__('You saved the Task.'));
                    $this->dataPersistor->clear('tudd_task');
                    $this->_eventManager->dispatch(self::EVENT_NAME);
                    if ($this->getRequest()->getParam('back')) return $resultRedirect->setPath('*/*/edit', ['task_id' => $model->getId()]);
                    
                    return $resultRedirect->setPath('*/*/');
                } catch (LocalizedException $e) {
                    /** @noinspection PhpRedundantCatchClauseInspection */ 
                    $this->messageManager->addErrorMessage($e->getMessage());
                } catch (Exception $e) {
                    $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Task.'));
                }

                $this->dataPersistor->set('tudd_task', $data);

                return $resultRedirect->setPath('*/*/edit', ['task_id' => $this->getRequest()->getParam('task_id')]);
            }

            
        }

        return $resultRedirect->setPath('*/*/');
    }
}
