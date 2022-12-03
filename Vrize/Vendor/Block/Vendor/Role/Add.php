<?php
namespace Vrize\Vendor\Block\Vendor\Role;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Add extends Template
{
    /**
     * phpcs:disable Generic.CodeAnalysis.UselessOverridingMethod
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Form Action
     */
    public function getFormAction()
    {
        return $this->getUrl('vendor/role/save', ['_secure' => true]);
    }
}
