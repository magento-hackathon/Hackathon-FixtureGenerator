<?php

abstract class Hackathon_FixtureGenerator_Model_Processor_Abstract
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{
    const XML_PATH_TESTDATA_PROCESSOR = 'phpunit/testdata/processor/%s';

    protected $type;

    /**
     *
     * @var Hackathon_FixtureGenerator_Model_Generator_Container[]
     */
    protected $generators = array();

    protected $requiredKeys = array();

    /**
     * Returns base configuration path
     *
     * @return string
     */
    public function getConfigPath()
    {
        return sprintf(self::XML_PATH_TESTDATA_PROCESSOR, $this->type);
    }

    /**
     * @param $attribute
     *
     */
    public function getDefaultValue($attribute)
    {
        $fieldPath = $this->getConfigPath() . '/' . $attribute;
        return (string)Mage::getConfig()->getNode($fieldPath);
    }

    /**
     * Returns required keys
     *
     * @return array
     */
    public function getRequiredKeys()
    {
        return $this->requiredKeys;
    }

    /**
     * Returns default data array
     *
     * @return string[]
     */
    public function getDefaultData()
    {
        $data = array();
        foreach ($this->getRequiredKeys() as $key) {
            $data[$key] = $this->getDefaultValue($key);
        }
        return $data;
    }

    /**
     * Initializes container generators
     *
     * @param string[] $data
     * @return Hackathon_FixtureGenerator_Model_Processor_Abstract
     */
    public function initialize($data)
    {
        foreach ($data as $key => $value) {
            if (!isset($this->generators[$key])) {
                $this->generators[$key] = Mage::getModel('hackathon_fixturegenerator/generator_container');
            }

            $this->generators[$key]->initialize($value);
        }

        return $this;
    }

    /**
     * Invokes container generators
     *
     * @param string[] $data
     * @return Hackathon_FixtureGenerator_Model_Processor_Abstract
     */
    public function generate($data)
    {
        $result = $data;
        foreach ($data as $key => $value) {
            $result[$key] = $this->generators[$key]->generate($result);
        }

        return $result;
    }
}
