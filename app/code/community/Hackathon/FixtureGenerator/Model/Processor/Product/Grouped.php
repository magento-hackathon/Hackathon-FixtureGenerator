<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Grouped
    extends Hackathon_FixtureGenerator_Model_Processor_Product_Abstract {

    protected $type = 'product/grouped';

    protected $productType = 'grouped';

    public function __construct(){
        $this->dropRequiredKey('weight');
    }

}
