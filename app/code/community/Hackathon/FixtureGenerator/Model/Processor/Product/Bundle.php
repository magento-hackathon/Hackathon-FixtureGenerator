<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Bundle
    extends Hackathon_FixtureGenerator_Model_Processor_Product_Abstract
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{

    protected $type = 'product/bundle';

    protected $productType = 'bundle';

    public function __construct(){
        $this->dropRequiredKey('tax_class_id');
        $this->dropRequiredKey('weight');
    }
}