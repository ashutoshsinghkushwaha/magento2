<?php
namespace Testimonial\Module\Controller\Index;
use Magento\Framework\App\Action\Action as Action;
use Magento\Framework\App\Action\Context as Context;
use Testimonial\Module\Model\ViewFactory as ViewFactory;
use Testimonial\Module\Model\ResourceModel\View\CollectionFactory as CollectionFactory;
// use Magento\Framework\Controller\Result\RawFactory as RawFactory;
use Magento\Framework\Controller\Result\JsonFactory as JsonFactory;

class Test extends Action { 

    public function __construct(Context $context, 
    \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
    JsonFactory $jsonFactory,
    ViewFactory $viewFactory,
    CollectionFactory $collectionFactory
    )
    {
        $this->resultForwardFactory = $resultForwardFactory;
        //$this->rawFactory = $rawFactory;
        $this->jsonFactory = $jsonFactory;
        $this->viewFactory = $viewFactory;
        $this->collectionFactory = $collectionFactory;

        parent::__construct($context);
    }
    public function execute()
    {
        $dataCollection = $this->collectionFactory->create();
        // $dataCollection = $dataCollection->addFieldToSelect('*')->addFieldToFilter('score','3')->load()->getItems();
        $dataCollection = $dataCollection->addFieldToSelect(['name','score'])->addFieldToFilter('score','3')->setPageSize(2)->setOrder('name','DESC')->load()->getItems();
        // echo $dataCollection->getSelect()->__toString();
        echo count($dataCollection); //count collection records
        
        foreach($dataCollection as $data){
            echo "<pre>";
            print_r($data->getData());    
        }

        
        die;

    //     $data = $this->viewFactory->create();

    //     //Featching data 
    //     // print_r($data->load(4)->getData());
    //     $arr=Array ('id'=> 6,'image'=> "JDFJD.JPG ",'name' =>"yyyy", 'remarks' => "dfs ",'score'=>'5','created_at'=>"2022-11-18 13:03:05");
        
        
    //     // $model = $data->load(5);
    //     // $model['id'];
    
    //     // $id = $this->_request->getParam('id');
    //     // $model->setData($arr);

    //     $data->load(5)->setData($arr);
    //     $data->save();
    //     // $data->load(4)->delete();

    // //    print_r($data->load(1)->getData());
    //    exit;
    
    //     // echo "Bluethink";
    //     // this is for forward URL.
    //     // $resultForward = $this->resultForwardFactory->create();
    //     // return $resultForward->forward('index');
    //     // $rawFactory = $this->rawFactory->create();
    //     // return $rawFactory->setContents("this is test");
    //     $jsonFactory = $this->jsonFactory->create();
    //     $data=[
    //         "color"=>"red",
    //         "color1"=>"green"
    //     ];
    //     return $jsonFactory->setData($data);

    }
}