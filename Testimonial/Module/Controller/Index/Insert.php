<?php

namespace Testimonial\Module\Controller\Index;


use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Insert extends \Magento\Framework\App\Action\Action
{
    protected $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }
    
    public function execute()
    {
        // echo "grgfes";
        // die;
        $pageFactory = $this->pageFactory->create();
        return $this->pageFactory->create();
    }
}