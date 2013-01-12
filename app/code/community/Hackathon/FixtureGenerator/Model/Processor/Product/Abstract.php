<?php

abstract class Hackathon_FixtureGenerator_Model_Processor_Product_Abstract
	implements Hackathon_FixtureGenerator_Model_Processor_Interface {

	protected $generators = array();

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

		if (isset($data['number'])){
			$numberOfIterations = $data['number'];
			unset($data['number']);
		}

		$data = $this->getMergedAttributes($data);

		$products = array();
		for ($i = 1; $i <= $numberOfIterations; $i++) {
			$productData = $this->generateProduct($data);
			$products[] = $productData;
		}
		return $products;
	}

	/**
	 * Get merged array of default and set attributes
	 *
	 * @param $data
	 * @return array
	 */
	protected function getMergedAttributes($data) {
	// Get default values for the required attributes and merge it with the passed data
		$requiredAttributes = $this->getRequiredAttributes();
		$defaultData = array();
		foreach ($requiredAttributes as $attribute) {
			$defaultData[$attribute] = $this->getDefaultValue($attribute);
		}
		$data = $data + $defaultData;
		return $data;
	}

	/**
	 * Generates one product depending on the data provided
	 *
	 * @param $data
	 * @return array
	 */
	protected function generateProduct($data) {
		$productData = array();
		foreach ($data as $key => $value) {
			if (!isset($this->generators[$key])) {
				$this->generators[$key] = Mage::getModel('hackathon_fixturegenerator/generator_container');
				$this->generators[$key]->initialize($value);
			}
			$productData[$key] = $this->generators[$key]->generate($productData);
		}
		return $productData;
	}

	/**
	 * Retrieve an array with the required attributes for this product
	 *
	 * @return array
	 */
	protected function getRequiredAttributes()
	{
		$attributes = array(
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
		return $attributes;
	}

	/**
	 * Read the default value from the config.xml, if no value is given in the data provider.
	 *
	 * @param string $attribute
	 * @return string
	 */
	protected function getDefaultValue($attribute)
	{
		$node = 'phpunit/testdata/processor/product/simple/'.$attribute;
		return (string) Mage::getConfig()->getNode($node);
	}

}