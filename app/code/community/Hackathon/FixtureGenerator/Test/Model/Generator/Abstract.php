<?php

class Hackathon_FixtureGenerator_Test_Model_Generator_Abstract extends EcomDev_PHPUnit_Test_Case
{
    protected $generator = null;

    protected function setUp()
    {

    }

    /**
     *
     *
     * @param array $currentRow
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testGenerate(array $currentRow, $string)
    {
        $this->generator = $this->getMockForAbstractClass('Hackathon_FixtureGenerator_Model_Generator_Abstract', array($string));
        $dataSet = $this->readAttribute($this, 'dataName');
        $this->assertEquals($this->expected()->getData($dataSet), $this->generator->generate($currentRow));
    }
}