<?php

class Hackathon_FixtureGenerator_Test_Helper_Data extends EcomDev_PHPUnit_Test_Case
{
    /**
     * Tests set path value method of helper
     *
     * @param $key
     * @param $value
     * @param $array
     *
     * @dataProvider dataProvider
     */
    public function testUpdatePathValue($key, $value, $array)
    {
        Mage::helper('hackathon_fixturegenerator')->updatePathValue($key, $value, $array);
        $this->assertEquals($this->expected('auto')->getArray(), $array);
    }
}