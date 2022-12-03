<?php
namespace Testimonial\Module\Controller\Index;

use Testimonial\Module\Model\ViewFactory;

class Delete extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    protected $viewFactory;


    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       ViewFactory $viewFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->viewFactory = $viewFactory;

        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       $id = $this->getRequest()->getParam('id');
       $deleterecord = $this->viewFactory->create()->load($id);
       if($deleterecord->delete())
        {
            $this->messageManager->addSuccessMessage(
                __('Deleted successfully')
            );
        }
        else 
        {
            $this->messageManager->addErrorMessage(
                __('Not Deleted')
            );
        }
        return $this->resultRedirectFactory->create()->setPath('testimonial/index/index');
        
      
    }
}
