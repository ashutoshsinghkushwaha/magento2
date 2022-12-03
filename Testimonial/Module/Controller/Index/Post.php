<?php
namespace Testimonial\Module\Controller\Index;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Testimonial\Module\Model\SavePost;

class Post extends Action
{
/**
* @var DataPersistorInterface
*/
private $dataPersistor;

/**
* @var Context
*/
private $context;

/**
* @var UploaderFactory
*/
protected $uploaderFactory;

/**
* @var AdapterFactory
*/
protected $adapterFactory;

/**
* @var Filesystem
*/
protected $filesystem;

/**
* @var SavePost
*/
protected $savepost;

/**
* @param Context $context
*/
public function __construct(
    Context $context,
    DataPersistorInterface $dataPersistor,
    UploaderFactory $uploaderFactory,
    AdapterFactory $adapterFactory,
    Filesystem $filesystem,
    SavePost $savepost
) {
    $this->dataPersistor = $dataPersistor;
    $this->context = $context;
    $this->uploaderFactory = $uploaderFactory;
    $this->adapterFactory = $adapterFactory;
    $this->filesystem = $filesystem;
    $this->savepost = $savepost;
    parent::__construct($context);
}

/**
* Prints the information
* @return Page
*/
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
        return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $data = $this->validatedParams();
           
            $files= $this->getRequest()->getFiles();
            if (isset($files['image']) && !empty($files['image']["name"])){
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image']);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'png']);
                $uploaderFactory->setAllowRenameFiles(true);
                //$uploaderFactory->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('bluethink');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(__('File cannot be saved to path: $1', $destinationPath));
                }
                $imageName = $result['name'];
                $data['image'] = $imageName;
                // echo "<pre>";
                // print_r($data);
                // die;
            }


                $email=$data['email'];
       
                 if (!empty($data['id'])) {
                    $this->savepost->createRecord($data);
                     $this->messageManager->addSuccessMessage(
                         __('Record Updated successfully')
                     );
                     return $this->_redirect('testimonial/index/index');
                 }else{
                        if($this->savepost->checkEmailExist($email)==true){
                            $this->savepost->createRecord($data);
                            $this->messageManager->addSuccessMessage(
                            __('Record Added successfully')
                        );
                        return $this->_redirect('testimonial/index/index');
                        }else{
                            throw new LocalizedException(__('This Email id is Already Exist'));
                            
                         }
                         return $this->_redirect('testimonial/index/insert');
                }

        //     $email=$data['email'];
        //    if($this->savepost->checkEmailExist($email)==true){
        //         $this->savepost->createRecord($data);
        //         if (!empty($data['id'])) {
        //             $this->messageManager->addSuccessMessage(
        //                 __('Record Updated successfully')
        //             );
        //             return $this->_redirect('testimonial/index/index');
        //         } else {
        //             $this->messageManager->addSuccessMessage(
        //                 __('Record Added successfully')
        //             );
        //             return $this->_redirect('testimonial/index/index');
        //         }
        //    } else{
        //     throw new LocalizedException(__('This Email id is Already Exist'));
        //     return $this->_redirect('testimonial/index/insert');
        //    }

          $this->dataPersistor->clear('apply_here');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('apply_here', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
            __('An error occurred while processing your form. Please try again later.'));
            $this->dataPersistor->set('apply_here', $this->getRequest()->getParams());
        }
        // $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        // $redirectUrl = $this->_redirect->getRedirectUrl();
        // return $redirect->setUrl($redirectUrl);

    }

    /**
    * Method to validated params.
    *
    * @return array
    * @throws \Exception
    */

    private function validatedParams() {
        $request = $this->getRequest();
        
        if (trim($request->getParam('name', '')) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }

        if (trim($request->getParam('email', '')) === '') {
            throw new LocalizedException(__('Enter the Email and try again.'));
        }

        if (trim($request->getParam('score', '')) === '') {
            throw new LocalizedException(__('Enter the Score and try again.'));
        }

        if (trim($request->getParam('remarks', '')) === '') {
            throw new LocalizedException(__('Enter the Remark and try again.'));
        }
   
        if (trim($request->getParam('hideit', '')) !== '') {
            // phpcs:ignore Magento2.Exceptions.DirectThrow
            throw new \Exception();
        }
        return $request->getParams();
    }
}