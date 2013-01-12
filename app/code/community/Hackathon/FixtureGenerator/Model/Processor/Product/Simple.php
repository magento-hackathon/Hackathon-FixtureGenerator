<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Simple
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{
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
        $numberOfIterations = (isset($data['number'])) ? $data['number'] : 1;

        $products = array();
        for ($i = 1; $i <= $numberOfIterations; $i++) {
            $data = array(
                'entity_id' => $i,
                'type_id' => 'simple',
                'sku' => 'test_'.$i,
                'name' => 'Test '.$i
            );
            $products[] = $data;
        }
        return $products;
    }
}
