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
abstract class Hackathon_FixtureGenerator_Model_Processor_Product_Abstract
    extends Hackathon_FixtureGenerator_Model_Processor_Abstract
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{
    /**
     * @var array
     */
    protected $requiredKeys = array(
        'entity_id',
        'type_id',
        'description',
        'weight',
        'price',
        'tax_class_id',
        'status',
        'visibility',
        'description',
        'short_description'
    );

    /**
     * @var string
     */
    protected $productType = 'abstract';

	/**
	 * @param array $data array(
	 *   'number' => 2,
	 *   'sku' => 'SKU{id}',
	 *   'attribute_name' => '[value1, value2]'
	 * )
	 *
	 * @return array(
	 *   array(
	 *     'entity_id' => 1,
	 *     'type_id' => 'simple',
	 *     'sku' => 'sku,
	 *     'name' => 'Simple Product',
	 *    ..
	 *   )
	 * )
	 */
	public function process(array $data)
	{
		$numberOfIterations = 1;

		if (isset($data['number'])) {
			$numberOfIterations = $data['number'];
			unset($data['number']);
		}

		$data = array_merge($this->getDefaultData(), $data);

        $this->initialize($data);

		$products = array();
		for ($i = 1; $i <= $numberOfIterations; $i++) {
			$productData = $this->generate($data);
			$products[] = $productData;
		}
		return $products;
	}
}
