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
        unset($data['number']);


        $requiredAttributes = $this->getRequiredAttributes();
        $products = array();
        for ($i = 1; $i <= $numberOfIterations; $i++) {
            $productData = array();
            foreach ($data as $key => $value) {
                $productData[$key] = $this->getProcessedValue($value);
            }

            foreach ($requiredAttributes as $attribute) {
                if (!isset($productData[$attribute])) {
                    $defaultValue = $this->getDefaultValue($attribute);
                    $productData[$attribute] = $this->getProcessedValue($defaultValue);
                }
            }

            $products[] = $productData;
        }
        return $products;
    }

    public function getProcessedValue($string)
    {
        return $string;
    }

    public function getRequiredAttributes()
    {
        $attributes = array(
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
        return $attributes;
    }

    public function getDefaultValue($attribute)
    {
        $node = 'phpunit/testdata/processor/product/simple/'.$attribute;
        return (string) Mage::getConfig()->getNode($node);
    }
}
