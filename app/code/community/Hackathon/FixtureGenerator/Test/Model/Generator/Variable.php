<?php

class Hackathon_FixtureGenerator_Test_Model_Generator_Variable extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Tests variable generation
     *
     * @param array $currentRow
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testGenerate(array $currentRow, $string)
    {
        $generator = new Hackathon_FixtureGenerator_Model_Generator_Variable($string);
        $dataSet = $this->readAttribute($this, 'dataName');
        $this->assertEquals($this->expected()->getData($dataSet), $generator->generate($currentRow));
    }
}