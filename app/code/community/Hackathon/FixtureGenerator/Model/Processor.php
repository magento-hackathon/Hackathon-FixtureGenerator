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

/**
 * Fixture processor class
 */
class Hackathon_FixtureGenerator_Model_Processor implements EcomDev_PHPUnit_Model_Fixture_Processor_Interface
{
    const XML_PATH_PROCESSORS = 'phpunit/suite/fixture/generator/processors';

    protected $fixtures = array();

    public function __construct()
    {
        foreach (Mage::getConfig()->getNode(self::XML_PATH_PROCESSORS)->children() as $processor) {
            $this->fixtures[$processor->getName()] = array(
                'type' => (string)$processor->type,
                'path' => (string)$processor->path,
                'model' => (string)$processor->model
            );
        }
    }

    /**
     * Applies data from fixture file
     *
     * @param array[]                                 $data
     * @param string                                  $key
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     *
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function apply(array $data, $key, EcomDev_PHPUnit_Model_FixtureInterface $fixture)
    {
        // Does nothing
    }

    /**
     * Discards data from fixture file
     *
     * @param array[]                                 $data
     * @param string                                  $key
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     *
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function discard(array $data, $key, EcomDev_PHPUnit_Model_FixtureInterface $fixture)
    {
        // Does nothing
    }

    /**
     * Initializes fixture processor before applying data
     *
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function initialize(EcomDev_PHPUnit_Model_FixtureInterface $fixture)
    {
        $generateData = $fixture->getFixtureValue('generate');
        $fixtureData = array();
        foreach ($generateData as $generateByTypes) {
            foreach ($generateByTypes as $type => $data) {
               if (!isset($this->fixtures[$type]['path'])) {
                   continue;
               }
               $path = $this->fixtures[$type]['path'];
               $fixtureType = isset($this->fixtures[$type]['type']) ? $this->fixtures[$type]['type'] : 'tables';
               if (!isset($fixtureData[$fixtureType][$path])) {
                   $fixtureData[$fixtureType][$path] = array();
               }

                $fixtureData[$fixtureType][$path] = array_merge(
                    $fixtureData[$fixtureType][$path],
                   Mage::getSingleton($this->fixtures[$type]['model'])->process($data)
               );
            }
        }

        foreach ($fixtureData as $type => $entities) {
            $fixtureValue = $fixture->getFixtureValue($type);
            foreach ($entities as $path => $records) {
                Mage::helper('hackathon_fixturegenerator')->updatePathValue(
                    $path, $records, $fixtureValue
                );
            }

            $fixture->setFixtureValue($type, $fixtureValue);
        }

        return $this;
    }
}
