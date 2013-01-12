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

    /**
     * Calls the generator interface which returns the correct value for the given value
     *
     * @param $value
     * @return mixed
     */
    public function getProcessedValue($value)
    {
        return $value;
    }

    /**
     * Retrieve an array with the required attributes for this product
     *
     * @return array
     */
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

    /**
     * Read the default value from the config.xml, if no value is given in the data provider.
     *
     * @param string $attribute
     * @return string
     */
    public function getDefaultValue($attribute)
    {
        $node = 'phpunit/testdata/processor/product/simple/'.$attribute;
        return (string) Mage::getConfig()->getNode($node);
    }
}
