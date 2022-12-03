<?php

namespace Testimonial\Module\Block;

use Magento\Framework\View\Element\Template;

class Myform extends Template
{
    
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

   
    public function getFormAction()
    {
        return $this->getUrl('testimonial/index/post', ['_secure' => true]);
    }
}
