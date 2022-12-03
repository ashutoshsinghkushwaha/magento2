<?php

namespace Vrize\Vendor\Block\Vendor;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class AccountDetailsSidebar extends Template
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
     * Retrieve block title
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTitle()
    {
        return __('Vendor Info');
    }

    /**
     * Return vendor profile url
     *
     * @return mixed
     */
    public function getVendorProfileUrl()
    {
        return $this->getUrl('vendor/vendor/profile');
    }

    /**
     * Manage products url
     */
    public function getProductsUrl()
    {
        return $this->getUrl('vendor/products/manage');
    }

    /**
     * Current url
     */
    public function getCurrentUrl()
    {
        return $this->_urlBuilder->getCurrentUrl();
    }
    /**
     * Manage users url
     */
    public function getUsersUrl()
    {
        return $this->getUrl('vendor/user');
    }
    /**
     * Manage roles url
     */
    public function getRolesUrl()
    {
        return $this->getUrl('vendor/role');
    }
}
