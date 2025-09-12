<?php
namespace MinhaLoja\GridProductBanner\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // Atributo para definir se é banner
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'is_banner_product',
            [
                'type' => 'int',
                'label' => 'É um Banner/Propaganda?',
                'input' => 'boolean',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required' => false,
                'default' => 0,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => true,
                'visible_on_front' => false,
                'group' => 'General',
                'sort_order' => 200
            ]
        );

        // Atributo para o link do banner
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'banner_link_url',
            [
                'type' => 'varchar',
                'label' => 'URL do Banner',
                'input' => 'text',
                'required' => false,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => true,
                'visible_on_front' => false,
                'group' => 'General',
                'sort_order' => 201,
                'note' => 'URL para onde o banner deve levar quando clicado'
            ]
        );

        // Atributo para classe CSS customizada do banner
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'banner_css_class',
            [
                'type' => 'varchar',
                'label' => 'Classe CSS do Banner',
                'input' => 'text',
                'required' => false,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => true,
                'visible_on_front' => false,
                'group' => 'General',
                'sort_order' => 202,
                'note' => 'Classe CSS para customizar o banner'
            ]
        );
    }
}