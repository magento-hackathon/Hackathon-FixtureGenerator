<?php

class Hackathon_FixtureGenerator_Test_Model_Processor_Customer extends EcomDev_PHPUnit_Test_Case
{
    /**
     *
     * @dataProvider dataProvider
     */
    public function testProcess($data)
    {
        /**
         * @var $processor Hackathon_FixtureGenerator_Model_Processor_Customer
         */
        $processor = Mage::getModel('hackathon_fixturegenerator/processor_customer');
        $this->assertEquals($this->expected('auto')->getCustomers(), $processor->process($data));
    }
}
