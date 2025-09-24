<?php
namespace MinhaEmpresa\MeuModulo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ObjectManager;
use Psr\Log\LoggerInterface;

class AddCustomCssClass implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $collection = $observer->getEvent()->getCollection();
        $collection->addAttributeToSelect('custom_css_class');

        /** @var LoggerInterface $logger */
        $logger = ObjectManager::getInstance()->get(LoggerInterface::class);
        $logger->debug('[MinhaEmpresa_MeuModulo] catalog_block_product_list_collection observer executed. Items: ' . $collection->getSize());
    }
}