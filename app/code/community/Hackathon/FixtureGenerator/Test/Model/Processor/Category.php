<?php
class Hackathon_FixtureGenerator_Test_Model_Processor_Category extends EcomDev_PHPUnit_Test_Case
{
    /**
     *
     * @dataProvider dataProvider
     */
    public function testProcess($data)
    {
        /**
         * @var $processor Hackathon_FixtureGenerator_Model_Processor_Category
         */
        $processor = Mage::getModel('hackathon_fixturegenerator/processor_category');
        $this->assertEquals($this->expected('auto')->getCategories(), $processor->process($data));
    }
}