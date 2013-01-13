<?php
/**
 * Fixture Generator module for PHP Unit test suite for Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Hackathon
 * @package    Hackathon_FixtureGenerator
 * @author     Peter Jaap Blaakmeer <https://github.com/peterjaap>
 * @author     Ivan Chepurnyi <https://github.com/IvanChepurnyi>
 * @author     Dima Janzen <https://github.com/dimajanzen>
 * @author     Rouven Alexander Rieker <https://github.com/therouv>
 * @author     Michael Ryvlin <https://github.com/mryvlin>
 * @copyright  2013 Hackathon Dev Team (http://www.magento-hackathon.de/)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link       https://github.com/magento-hackathon/Hackathon-FixtureGenerator/
 */
abstract class Hackathon_FixtureGenerator_Model_Processor_Abstract
    implements Hackathon_FixtureGenerator_Model_Processor_Interface
{
    const XML_PATH_TESTDATA_PROCESSOR = 'phpunit/testdata/processor/%s';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var Hackathon_FixtureGenerator_Model_Generator_Container[]
     */
    protected $generators = array();

    /**
     * @var array
     */
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
