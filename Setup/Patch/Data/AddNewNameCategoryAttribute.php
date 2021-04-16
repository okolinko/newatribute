<?php

declare(strict_types=1);

namespace Luxinten\NewNameCategory\Setup\Patch\Data;

use Magento\Catalog\Model\Category;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Model\Entity\Attribute\Source\Boolean;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;


/**
 * Class AddNewNameCategoryAttribute
 * @package Luxinten\NewNameCategory\Setup\Patch\Data
 */
class AddTimedCategoryAttribute implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * AddNewNameCategoryAttribute constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     * @param CategorySetupFactory     $categorySetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * @return AddNewNameCategoryAttribute|void
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(Category::ENTITY, 'new_name', [
            'type' => 'varchar',
            'label' => 'Overwrite Page Heading',
            'input' => 'text',
            'source' => '',
            'global'       => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_STORE,
            'required'     => false,
            'default'      => null,
            'group'        => 'Mygroup',
            'sort_order'   => 100,
        ]);

    }

    /**
     * @return array|string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array|string[]
     */
    public function getAliases()
    {
        return [];
    }
}
