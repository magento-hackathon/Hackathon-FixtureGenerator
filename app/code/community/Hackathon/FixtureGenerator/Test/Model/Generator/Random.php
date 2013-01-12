<?php

class Hackathon_FixtureGenerator_Test_Model_Generator_Random extends EcomDev_PHPUnit_Test_Case
{
    protected $generator = null;

    /**
     * @param array $currentRow
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testGenerate(array $currentRow, $string)
    {

		$this->generator = Mage::getModel('hackathon_fixturegenerator/generator_random');
        $dataSet = $this->readAttribute($this, 'dataName');

		$expextedRange = $this->expected()->getData($dataSet);

		$generatedValue = $this->generator->generate($string);

		$this->assertGreaterThanOrEqual($expextedRange['from'], $generatedValue);
		$this->assertLessThanOrEqual($expextedRange['to'], $generatedValue);
    }
}