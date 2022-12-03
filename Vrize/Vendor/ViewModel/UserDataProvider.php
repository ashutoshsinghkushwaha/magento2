<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Vrize\Vendor\ViewModel;

use Vrize\Vendor\Helper\Data;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Provides the user data to fill the form.
 */
class UserDataProvider implements ArgumentInterface
{

    /**
     * @var Data
     */
    private $helper;

    /**
     * UserDataProvider constructor.
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

     /**
      * Get user name
      *
      * @return string
      */
    public function getUserName()
    {
        return $this->helper->getPostValue('name');
    }

     /**
      * Get user name
      *
      * @return string
      */
    public function getUserLastName()
    {
        return $this->helper->getPostValue('last_name');
    }

      /**
       * Get user email
       *
       * @return string
       */
    public function getUserEmail()
    {
        return $this->helper->getPostValue('email');
    }
    /**
     * Get user name
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->helper->getPostValue('role_name');
    }
}
