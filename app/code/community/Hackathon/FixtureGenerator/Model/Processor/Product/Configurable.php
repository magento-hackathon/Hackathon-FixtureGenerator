<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Configurable
    extends Hackathon_FixtureGenerator_Model_Processor_Product_Abstract {

    protected $type = 'product/configurable';

    protected $productType = 'configurable';

    public function __construct(){
        $this->dropRequiredKey('weight');
    }

}
