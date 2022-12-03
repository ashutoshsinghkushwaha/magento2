<?php

namespace Vrize\Vendor\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Registration extends Template
{
    /**
     * Registration constructor.
     *
     * @param Context $context
     * @param CustomerYesNoOptions $isVendorOptions
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Vrize\Vendor\Model\Config\Source\CustomerYesNoOptions $isVendorOptions,
        array $data
    ) {
        $this->isVendorOptions = $isVendorOptions;
        parent::__construct($context, $data);
    }

    /**
     * Vendor
     */
    public function getIsVendorHTML()
    {
        return '';
    }
}
