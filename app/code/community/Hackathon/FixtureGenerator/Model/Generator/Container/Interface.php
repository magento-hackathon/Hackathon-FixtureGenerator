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
 * Generator interface for fixture generator
 *
 * Usage:
 *
 * $container = new GeneratorContainer();
 * $container->initialize($stringValue); // {range:1,5,1}|{increment:1}
 * $rows = array();
 * for ($i = 0; $i < $numberOfTimes; $i ++) {
 *    $rows[$i]['attribute'] = $container->generate($rows[$i]);
 * }
 *
 */
interface Hackathon_FixtureGenerator_Model_Generator_Container_Interface
{
    /**
     * @param string $string
     *
     * @return Hackathon_FixtureGenerator_Model_Generator_Container_Interface
     */
    public function initialize($string);

    /**
     * Generates a string with data of row
     *
     * @param array $rowData
     *
     * @return string
     */
    public function generate($rowData);

}
