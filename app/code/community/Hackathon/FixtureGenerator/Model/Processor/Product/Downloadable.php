<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Downloadable
    extends Hackathon_FixtureGenerator_Model_Processor_Product_Abstract
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{

    protected $type = 'product/downloadable';

    protected $productType = 'downloadable';

    public function __construct(){
        $this->dropRequiredKey('weight');
    }

}