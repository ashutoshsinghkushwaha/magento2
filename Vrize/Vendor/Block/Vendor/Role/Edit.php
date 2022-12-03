<?php
 
namespace Vrize\Vendor\Block\Vendor\Role;
 
class Edit extends \Magento\Framework\View\Element\Template
{
    /** @var PageFactory */
    protected $_pageFactory;

    /** @var Registry */
    protected $_coreRegistry;

    /** @var RoleFactory */
    protected $_contactLoader;
 
    /**
     * Construct
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Registry $coreRegistry
     * @param RoleFactory $contactLoader
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Vrize\Vendor\Model\RoleFactory $contactLoader,
        array $data = []
    ) {
         $this->_pageFactory = $pageFactory;
         $this->_coreRegistry = $coreRegistry;
         $this->_contactLoader = $contactLoader;
         return parent::__construct($context, $data);
    }
    
    /**
     * Page
     */
    public function execute()
    {
         return $this->_pageFactory->create();
    }

    /**
     * Form Action
     */
    public function getFormAction()
    {
        return $this->getUrl('vendor/role/save', ['_secure' => true]);
    }
 
    /**
     * Edit Data
     */
    public function getEditData()
    {
         $id = $this->_coreRegistry->registry('role_id');
         $postData = $this->_contactLoader->create();
         $result = $postData->load($id);
         $result = $result->getData();
         return $result;
    }
}
