<?php

class Hackathon_FixtureGenerator_Test_Model_Processor_Product_Virtual extends EcomDev_PHPUnit_Test_Case {

	protected $processor = null;

	protected function setUp()
	{
		$this->processor = Mage::getModel('hackathon_fixturegenerator/processor_product_virtual');
	}

	/**
	 * @param array $data
	 * @dataProvider dataProvider
	 */
	public function testProcess(array $data)
	{
		/*
		$dataSet = $this->readAttribute($this, 'dataName');

		$numberOfIterations = (isset($data['number'])) ? $data['number'] : 1;
		$processedData = $this->processor->process($data);

		for ($i = 1; $i <= $numberOfIterations; $i++) {
			$this->assertEquals(
				$this->expected($dataSet)->getData('product_'.$i),
				$processedData[$i-1],
				'Assertation for product ' . $i . ' failed'
			);
		}
		*/
	}
}