<?php

class Hackathon_FixtureGenerator_Test_Model_Processor_Customer_Address extends EcomDev_PHPUnit_Test_Case
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
        $processor = Mage::getModel('hackathon_fixturegenerator/processor_customer_address');
        $this->assertEquals($this->expected('auto')->getAddresses(), $processor->process($data));
    }
}
