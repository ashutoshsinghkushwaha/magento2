<?php
namespace Vrize\Vendor\Block\Vendor;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Add extends Template
{
    /**
     * phpcs:disable Generic.CodeAnalysis.UselessOverridingMethod
     *
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Form Action
     */
    public function getFormAction()
    {
        return $this->getUrl('vendor/user/save', ['_secure' => true]);
    }
}
