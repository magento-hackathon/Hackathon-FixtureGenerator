<?php

class Hackathon_FixtureGenerator_Test_Model_Processor_Product extends EcomDev_PHPUnit_Test_Case
{


    /**
     *
     * @dataProvider dataProvider
     */
    public function testProcess($data)
    {
        /**
         * @var $processor Hackathon_FixtureGenerator_Model_Processor_Product
         */
        $processor = Mage::getModel('hackathon_fixturegenerator/processor_product');
        $this->assertEquals($this->expected('auto')->getProducts(), $processor->process($data));
    }
}
