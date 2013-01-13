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
class Hackathon_FixtureGenerator_Model_Generator_Variable extends Hackathon_FixtureGenerator_Model_Generator_Abstract
{
    public function generate(array $data)
    {
        $generatedString = $this->format;
        if (preg_match_all('/\\{\\$(.*)\\}/', $this->format, $vars)) {
            $replace = array();
            foreach ($vars[1] as $index => $variableName) {
                if (isset($data[$variableName])) {
                    $value = $data[$variableName];
                } else {
                    $value = '';
                }
                $replace[$vars[0][$index]]=$value;
            }

            $generatedString = strtr($generatedString, $replace);
        }
        return $generatedString;
    }
}
