<?php

class Hackathon_FixtureGenerator_Model_Processor_Customer_Address
    extends Hackathon_FixtureGenerator_Model_Processor_Abstract
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{
    protected $type = 'customer_address';

    protected $requiredKeys = array(
        'entity_id',
        'parent_id',
        'firstname',
        'lastname',
        'street',
        'city',
        'country_id',
        'region_id',
        'postcode',
        'telephone'
    );

    /**
     * @param array $data array(
     *   'number' => 2,
     *   'email' => 'test.customer{$entity_id}@testcompany.com',
     *   'attribute_name' => '{random:1,2}|{range:0,1000,1}'
     * )
     *
     * @return array
     */
    public function process(array $data)
    {
        $numberOfIterations = 1;

        if (isset($data['number'])){
            $numberOfIterations = $data['number'];
            unset($data['number']);
        }

        $data = array_merge($this->getDefaultData(), $data);

          $this->initialize($data);

        $customers = array();
        for ($i = 1; $i <= $numberOfIterations; $i++) {
            $customerData = $this->generate($data);
            $customers[] = $customerData;
        }
        return $customers;
    }
}
