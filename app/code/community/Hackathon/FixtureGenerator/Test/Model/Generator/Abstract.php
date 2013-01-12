<?php

class Hackathon_FixtureGenerator_Test_Model_Generator_Abstract extends EcomDev_PHPUnit_Test_Case
{

    /**
     * @param $string
     * @dataProvider dataProvider
     */
    public function testConstructor($string)
    {
        $generator = $this->getMockForAbstractClass(
            'Hackathon_FixtureGenerator_Model_Generator_Abstract',
            array($string)
        );
        $this->assertAttributeSame($string, 'format', $generator);
    }

}