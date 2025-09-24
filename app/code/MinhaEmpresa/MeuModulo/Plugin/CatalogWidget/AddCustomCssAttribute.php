<?php
namespace MinhaEmpresa\MeuModulo\Plugin\CatalogWidget;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\CatalogWidget\Block\Product\ProductsList;

class AddCustomCssAttribute
{
    /**
     * Ensure custom_css_class attribute is selected for Page Builder product widgets.
     *
     * @param ProductsList $subject
     * @param Collection|null $collection
     * @return Collection|null
     */
    public function afterGetProductCollection(ProductsList $subject, $collection)
    {
        if ($collection instanceof Collection) {
            $collection->addAttributeToSelect('custom_css_class');
        }

        return $collection;
    }
}
