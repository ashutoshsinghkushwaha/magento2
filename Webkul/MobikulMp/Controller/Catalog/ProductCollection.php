<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_MobikulMp
 * @author    Webkul <support@webkul.com>
 * @copyright Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html ASL Licence
 * @link      https://store.webkul.com/license.html
 */

namespace Webkul\MobikulMp\Controller\Catalog;

/**
 * Class ProductCollection conreoller
 */
class ProductCollection extends \Webkul\MobikulApi\Controller\Catalog\ProductCollection
{
/**
     * Function to filter Product Collection
     *
     * @return void
     */
    public function filterProductCollection()
    {
        if (count($this->filterData) > 0) {
            $filterCount = count($this->filterData[0]);
            for ($i=0; $i<$filterCount; ++$i) {
                if ($this->filterData[0][$i] != "" && $this->filterData[1][$i] == "price") {
                    $priceRange = explode("-", $this->filterData[0][$i]);
                    $currencyRate = $this->collection->getCurrencyRate();
                    list($from, $to) = $priceRange;
                    $this->collection->addFieldToFilter(
                        "price",
                        ["from"=>$from, "to"=>empty($to) || $from == $to ? $to : $to - 0.001]
                    );
                    $this->catalogLayer->getState()->addFilter(
                        $this->helperCatalog->_createItem(empty($from) ? 0 : $from, $to, $priceRange)
                    );
                } elseif ($this->filterData[0][$i] != "" && $this->filterData[1][$i] == "cat") {
                    $categoryToFilter = $this->category->create()->load($this->filterData[0][$i]);
                    $this->collection->setStoreId($this->storeId)->addCategoryFilter($categoryToFilter);
                } elseif ($this->filterData[0][$i] != "" && $this->filterData[1][$i] == "seller") {
                    $seller_id = $this->filterData[0][$i];
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                    $marketplaceHelper = $objectManager->create(\Webkul\Marketplace\Helper\Data::class);
                    $products = $marketplaceHelper->getSellerProductCollection($seller_id);
                    $productIds = $products->getAllIds();
                    $this->collection->addFieldToFilter('entity_id', ['in' => $productIds]);
                } else {
                    $attribute = $this->eavConfig->getAttribute("catalog_product", $this->filterData[1][$i]);
                    $attributeModel = $this->layerAttribute->create()->setAttributeModel($attribute);
                    $this->collection->addFieldToFilter($attribute->getAttributeCode(), $this->filterData[0][$i]);
                    $this->catalogLayer
                        ->getState()
                        ->addFilter($this->helperCatalog->_createItem(
                            $this->filterData[0][$i],
                            $this->filterData[0][$i]
                        ));
                }
            }
        }
    }
}