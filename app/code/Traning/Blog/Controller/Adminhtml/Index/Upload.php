<?php

namespace Training\Blog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

//use Training\Blog\Model\ImageUploader;

class Upload extends Action
{
    protected $imageUploader;
    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    /**
     * Upload constructor.
     *
     * @param Action\Context $context
     * @param ImageUploader $imageUploader
     */
    public function __construct(
        Action\Context $context,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        DirectoryList $directoryList
//        ImageUploader $imageUploader
    ) {
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->directoryList = $directoryList;
        parent::__construct($context);
//        $this->imageUploader = $imageUploader;
    }

    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'image');
        try{
            $uploaderFactory = $this->uploaderFactory->create(['fileId' => $imageId]);
            $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();
            $uploaderFactory->addValidateCallback('blogs_image_upload',$imageAdapter,'validateUploadFile');
            $uploaderFactory->setAllowRenameFiles(true);
            $uploaderFactory->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead($this->directoryList::MEDIA);
            $destinationPath = $mediaDirectory->getAbsolutePath('repo/blogs');
            $result = $uploaderFactory->save($destinationPath);

            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }

            $imagePath = 'repo/blogs'.$result['file'];
            $data['image'] = $imagePath;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
