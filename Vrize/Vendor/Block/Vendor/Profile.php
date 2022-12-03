<?php
namespace Vrize\Vendor\Block\Vendor;

use Magento\Framework\View\Element\Template\Context;

class Profile extends \Magento\Framework\View\Element\Template
{
    /**
     * phpcs:disable Generic.CodeAnalysis.UselessOverridingMethod
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Page
     */
    public function getAboutVendor()
    {
        return '';
    }

    /**
     * Page
     */
    public function getSaveProfileUrl()
    {
        return $this->getUrl('Vendor/vendor/save');
    }
}
