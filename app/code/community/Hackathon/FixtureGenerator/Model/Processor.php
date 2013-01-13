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
class Hackathon_FixtureGenerator_Model_Processor implements EcomDev_PHPUnit_Model_Fixture_Processor_Interface
{
    /**
     * Applies data from fixture file
     *
     * @param array[]                                 $data
     * @param string                                  $key
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     *
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function apply(array $data, $key, EcomDev_PHPUnit_Model_Fixture_Interface $fixture)
    {

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
    public function discard(array $data, $key, EcomDev_PHPUnit_Model_Fixture_Interface $fixture)
    {

    }

    /**
     * Initializes fixture processor before applying data
     *
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function initialize(EcomDev_PHPUnit_Model_Fixture_Interface $fixture)
    {

    }
}
