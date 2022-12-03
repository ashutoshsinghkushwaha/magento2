<?php
namespace Vrize\Vendor\Block\Vendor\Resources;
 
class Resources extends \Magento\Framework\View\Element\Template
{
     /** @var PageFactory */
    protected $_pageFactory;

    /** @var Registry */
    protected $_coreRegistry;

    /** @var ResourcesFactory */
    protected $_resourcesFactory;
 
    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Registry $coreRegistry
     * @param ResourcesFactory $resourcesFactory
     * @param var $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Vrize\Vendor\Model\ResourcesFactory $resourcesFactory,
        array $data = []
    ) {
         $this->_pageFactory = $pageFactory;
         $this->_coreRegistry = $coreRegistry;
         $this->_resourcesFactory = $resourcesFactory;
         return parent::__construct($context, $data);
    }
 
    /**
     * Prints the information
     *
     * @return Page
     */
    public function execute()
    {
         return $this->_pageFactory->create();
    }

    /**
     * Form Action
     *
     * @return Url
     */
    public function getFormAction()
    {
        return $this->getUrl('vendor/resources/save', ['_secure' => true]);
    }

    /**
     * Id
     *
     * @return Id
     */
    public function getId()
    {
            $id = $this->_request->getParam('id');
            return $id;
    }
     
    /**
     * Get Resource
     *
     * @return $result
     */
    public function getEditData()
    {
         $id= $this->_request->getParam('id');
         $postData = $this->_resourcesFactory->create()->getCollection()->addFieldToSelect('resource_id')
         ->addFieldToFilter('role_id', $id)->addFieldToFilter('permission', 'allow');
         $result = $postData->load();
         $result = $result->getData();
         return $result;
    }
}
