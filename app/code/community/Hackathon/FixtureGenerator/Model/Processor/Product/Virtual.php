<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Virtual
    extends Hackathon_FixtureGenerator_Model_Processor_Product_Abstract
	implements Hackathon_FixtureGenerator_Model_Processor_Interface
{

	protected $type = 'product/virtual';

    protected $productType = 'virtual';

    protected $requiredKeys = array(
        'entity_id',
        'type_id',
        'description',
        'price',
        'tax_class_id',
        'status',
        'visibility',
        'description',
        'short_description'
    );
}
