<?php
/**
 * Fixture Generator module for PHP Unit test suite for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Hackathon
 * @package    Hackathon_FixtureGenerator
 * @author     Peter Jaap Blaakmeer <https://github.com/peterjaap>
 * @author     Ivan Chepurnyi <https://github.com/IvanChepurnyi>
 * @author     Dima Janzen <https://github.com/dimajanzen>
 * @author     Rouven Alexander Rieker <https://github.com/therouv>
 * @author     Michael Ryvlin <https://github.com/mryvlin>
 * @copyright  2013 Hackathon Dev Team (http://www.magento-hackathon.de/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link       https://github.com/magento-hackathon/Hackathon-FixtureGenerator/
 */
class Hackathon_FixtureGenerator_Model_Processor_Product implements Hackathon_FixtureGenerator_Model_Processor_Interface
{
    const TYPE_SIMPLE = Mage_Catalog_Model_Product_Type::TYPE_SIMPLE;
    const TYPE_CONFIGURABLE = Mage_Catalog_Model_Product_Type_Configurable::TYPE_CODE;
    const TYPE_GROUPED = Mage_Catalog_Model_Product_Type::TYPE_GROUPED;
    const TYPE_VIRTUAL = Mage_Catalog_Model_Product_Type::TYPE_VIRTUAL;
    const TYPE_DOWNLOADABLE = Mage_Downloadable_Model_Product_Type::TYPE_DOWNLOADABLE;
    const TYPE_BUNDLE = 'bundle';

    /**
     * @var array Product Types
     */
    protected static $types = array(
        self::TYPE_SIMPLE => 'hackathon_fixturegenerator/processor_product_simple',
        self::TYPE_GROUPED => 'hackathon_fixturegenerator/processor_product_grouped',
        self::TYPE_CONFIGURABLE => 'hackathon_fixturegenerator/processor_product_configurable',
        self::TYPE_BUNDLE => 'hackathon_fixturegenerator/processor_product_bundle',
        self::TYPE_VIRTUAL => 'hackathon_fixturegenerator/processor_product_virtual'
    );

    /**
     * @param array $data array(
     *   'simple' => array(
     *     'number' => 2,
     *     'sku' => 'SKU{$id}',
     *     'attribute_name' => '{random:1,2}|{range:0,1000,1}'
     *   ),
     *   'grouped' => array(
     *
     *   ),
     *   'configurable' => array(
     *
     *   ),
     *   'bundle' => array(
     *
     *   ),
     *   'virtual' => array(
     *
     *   ),
     *   'downloadable' => array(
     *
     *   )
     * )
     *
     * @return array
     */
    public function process(array $data)
    {
        $products = array();

        foreach ($data as $type => $typeData) {
            if (!isset(self::$types[$type])) {
                continue;
            }

            $model = Mage::getModel(self::$types[$type]);
            $typeProducts = $model->process($typeData);
            $products = array_merge($products, $typeProducts);
        }

        return $products;
    }
}
