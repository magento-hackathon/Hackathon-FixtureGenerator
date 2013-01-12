<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Virtual
	implements Hackathon_FixtureGenerator_Model_Processor_Interface
{

	protected $type_id = 'virtual';

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
	 *     'type_id' => 'virtual',
	 *     'sku' => 'sku,
	 *     'name' => 'Virtual Product',
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

		$products = array();
		/** @var $container Hackathon_FixtureGenerator_Model_Generator_Container */
		$container = Mage::getModel('hackathon_fixturegenerator/generator_container');
		for ($i = 1; $i <= $numberOfIterations; $i++) {

			$product = $this->generateProduct($i, $data, $container);


			$data = array(
				'entity_id' => $i,
				'type_id' => 'virtual',
				'sku' => 'test_'.$i,
				'name' => 'Test '.$i
			);
			$products[] = $data;
		}
		return $products;
	}

	/**
	 * @param array $data
	 * @param Hackathon_FixtureGenerator_Model_Generator_Container $container
	 * @return array
	 */
	protected function generateProduct($incrementId, array $data, Hackathon_FixtureGenerator_Model_Generator_Container $container){
		$product = array(
			'increment_id' => $incrementId,
			'type_id'	=> $this->type_id
		);
		foreach ($data as $key => $value){
			//$product[$key] = $container->generate()
		}
	}

}
