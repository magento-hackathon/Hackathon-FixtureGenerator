<?php

class Hackathon_FixtureGenerator_Test_Model_Generator_Random extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @param array $currentRow
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testGenerate(array $currentRow, $string)
    {

		$generator = new Hackathon_FixtureGenerator_Model_Generator_Random($string);
		$generatedValue = $generator->generate($currentRow);

		$this->assertGreaterThanOrEqual($this->expected('auto')->getFrom(), $generatedValue);
		$this->assertLessThanOrEqual($this->expected('auto')->getTo(), $generatedValue);

    }
}