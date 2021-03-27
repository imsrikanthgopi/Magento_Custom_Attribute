<?php

namespace Esgee\CustomerAttribute\Setup;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface 
{
    private $eavSetupFactory;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig
    ) 
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) 
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        // Text Field
        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'custom_text_field', [
            'label' => 'Custom Text Field',
            'system' => 0,
            'position' => 700,
            'sort_order' => 700,
            'visible' => true,
            'note' => '',
            'type' => 'varchar',
            'input' => 'text',
            ]
        );

        $this->getEavConfig()->getAttribute('customer', 'custom_text_field')->setData('is_user_defined', 1)->setData('is_required', 0)->setData('default_value', '')->setData('used_in_forms', ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout'])->save();

        // Dropdown Field
        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'custom_dropdown', [
            'label' => 'Custom Dropdown',
            'system' => 0,
            'position' => 710,
            'sort_order' => 710,
            'visible' => true,
            'note' => '',
            'type' => 'int',
            'input' => 'select',
            'source' => 'Ht\Mymodule\Model\Source\Customdropdown',
            ]
        );

        $this->getEavConfig()->getAttribute('customer', 'custom_dropdown')->setData('is_user_defined', 1)->setData('is_required', 0)->setData('default_value', '')->setData('used_in_forms', ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout'])->save();

        // Yes/No Field
        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'custom_yes_no', [
            'label' => 'Custom Yes/No',
            'system' => 0,
            'position' => 720,
            'sort_order' => 720,
            'visible' => true,
            'note' => '',
            'type' => 'int',
            'input' => 'boolean',
            'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            ]
        );

        $this->getEavConfig()->getAttribute('customer', 'custom_yes_no')->setData('is_user_defined', 1)->setData('is_required', 0)->setData('default_value', '')->setData('used_in_forms', ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit', 'adminhtml_checkout'])->save();
    }
    
    public function getEavConfig() {
        return $this->eavConfig;
    }
}