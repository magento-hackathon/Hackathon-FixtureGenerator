<?php

class Hackathon_FixtureGenerator_Model_Processor_Product_Simple
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{
    protected $generators = array();

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

        // Get default values for the required attributes and merge it with the passed data
        $requiredAttributes = $this->getRequiredAttributes();
        $defaultData = array();
        foreach ($requiredAttributes as $attribute) {
            $defaultData[$attribute] = $this->getDefaultValue($attribute);
        }
        $data =  $data + $defaultData;

        /* @var $generators Hackathon_FixtureGenerator_Model_Generator_Container[] */
        $generators = array();
        $products = array();
        for ($i = 1; $i <= $numberOfIterations; $i++) {
            $productData = array();
            foreach ($data as $key => $value) {
                if (!isset($generators[$key])) {
                    $generators[$key] = Mage::getModel('hackathon_fixturegenerator/generator_container');
                    $generators[$key]->initialize($value);
                }
                $productData[$key] = $generators[$key]->generate($productData);
            }

            $products[] = $productData;
        }
        return $products;
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
