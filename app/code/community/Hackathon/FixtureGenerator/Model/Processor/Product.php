<?php

class Hackathon_FixtureGenerator_Model_Processor_Product implements Hackathon_FixtureGenerator_Model_Processor_Interface
{

    /**
     * @param array $data array(
     *   'simple' => array(
     *     'number' => 2,
     *     'sku' => 'SKU{id}',
     *     'attribute_name' => '[value1, value2]'
     *   ),
     *   'grouped' => array(
     *
     *   ),
     *   'configurable' => array(
     *
     *   ),
     *   'bundle' => array(
     *
     *   ),
     *   'virtual' => array(
     *
     *   ),
     *   'downloadable' => array(
     *
     *   )
     * )
     *
     * @return array
     */
    public function process(array $data)
    {
        $products = array();
        foreach ($data as $type => $typeData) {
            $model = Mage::getSingleton('hackathon_fixturegenerator/processor_product_'.$type);
            $typeProducts = $model->process($typeData);
            $products = array_merge($products, $typeProducts);
        }
        return $products;
    }
}



/*
  - product:
     simple:
            number: 2
            sku: “SKU{id}”
            attribute_name: [value1, value2]
            another_attribute: “some{sku}some” // someSKU1some, someSKU2some
            attribute:
                range: [10, 100, 5]



 */
