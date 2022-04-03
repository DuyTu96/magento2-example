<?php

namespace Repo\Posts\Controller\Adminhtml\Index;

use Exception;
use Repo\Posts\Model\Blog;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Backend\Model\Auth\Session;

class Save extends Action
{
    const EVENT_NAME = 'repo_posts_controller_adminhtml_post_save';

    protected $dataPersistor;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;
    protected $authSession;
    protected $directoryList;

    /**
     * @param Context $context
     * @param UploaderFactory $uploaderFactory
     * @param DataPersistorInterface $dataPersistor
     * @param AdapterFactory $adapterFactory
     * @param Filesystem $filesystem
     * @param DirectoryList $directoryList
     * @param Session $authSession
     */
    public function __construct(
        Context $context,
        UploaderFactory $uploaderFactory,
        DataPersistorInterface $dataPersistor,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        DirectoryList $directoryList,
        Session $authSession
    ) {
        $this->uploaderFactory = $uploaderFactory;
        $this->dataPersistor = $dataPersistor;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->directoryList = $directoryList;
        $this->authSession = $authSession;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $user = $this->authSession->getUser();
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try{
                $imageId = $this->_request->getParam('param_name', 'image');
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => $imageId]);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload',$imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead($this->directoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('repo/posts');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }

                $imagePath = 'repo/posts' . $result['file'];
                $data['image'] = $imagePath;
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));

                return $resultRedirect->setPath('*/*/index');
            }
        }

        if ($data) {
            $data['created_by'] = $user->getUserId();
            $data['updated_by'] = $user->getUserId();
            $id = $this->getRequest()->getParam('id');

            $model = $this->_objectManager->create(Blog::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Post no longer exists.'));

                return $resultRedirect->setPath('*/*/index');
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Post.'));
                $this->dataPersistor->clear('posts');
                $this->_eventManager->dispatch(self::EVENT_NAME);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Post.'));
            }

            $this->dataPersistor->set('posts', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
