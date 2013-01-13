<?php

abstract class Hackathon_FixtureGenerator_Model_Processor_Product_Abstract
    extends Hackathon_FixtureGenerator_Model_Processor_Abstract
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{

    protected $requiredKeys = array(
        'entity_id',
        'type_id',
        'description',
        'weight',
        'price',
        'tax_class_id',
        'status',
        'visibility',
        'description',
        'short_description'
    );

    protected $productType = 'abstract';

    /**
     * @param array $data array(
     *   'number' => 2,
     *   'sku' => 'SKU{id}',
     *   'attribute_name' => '[value1, value2]'
     * )
     *
     * @return array(
     *   array(
     *     'entity_id' => 1,
     *     'type_id' => 'simple',
     *     'sku' => 'sku,
     *     'name' => 'Simple Product',
     *    ..
     *   )
     * )
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

        $products = array();
        for ($i = 1; $i <= $numberOfIterations; $i++) {
            $productData = $this->generate($data);
            $products[] = $productData;
        }
        return $products;
    }
}