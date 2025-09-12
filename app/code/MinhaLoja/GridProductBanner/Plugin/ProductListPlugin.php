<?php
namespace MinhaLoja\GridProductBanner\Plugin;

class ProductListPlugin
{
    public function beforeGetProductDetailsHtml(
        \Magento\Catalog\Block\Product\ListProduct $subject,
        \Magento\Catalog\Model\Product $product,
        $templateType = ''
    ) {
        if ($product->getData('is_banner_product') || $templateType === 'banner') {
            $subject->setTemplate('Magento_Catalog::product/list/item-banner.phtml');
        }
        
        return [$product, $templateType];
    }
}