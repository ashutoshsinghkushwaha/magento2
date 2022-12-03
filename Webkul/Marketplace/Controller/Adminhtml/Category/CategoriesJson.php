<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Webkul\Marketplace\Controller\Adminhtml\Category;

class CategoriesJson extends \Magento\Backend\App\Action
{
    /**
     * Ajax categories tree loader action
     *
     * @return void
     */
    public function execute()
    {
        $categoryId = $this->getRequest()->getParam('id', null);
        return $this->getResponse()->setBody(
            $this->_objectManager->get(
                \Webkul\Marketplace\Block\Adminhtml\Customer\Edit\Tab\Categories::class
            )->getTreeArray(
                $categoryId,
                true,
                1
            )
        );
    }
}
