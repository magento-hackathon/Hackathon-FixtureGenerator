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
 * Helper class
 */
class Hackathon_FixtureGenerator_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @param $path
     * @param $value
     * @param $array
     * @return Hackathon_FixtureGenerator_Helper_Data
     */
    public function updatePathValue($path, $value, &$array)
    {
        $path = preg_split('/(?<!\\\\)\\//', $path);

        $currentItem = &$array;

        for ($i = 0, $length=count($path); $i < $length; $i++) {
            $key = strtr($path[$i], array('\\/' => '/'));
            $nextKey = isset($path[$i+1]) ? $path[$i+1] : false;

            if ((!isset($currentItem[$key])
                    || !is_array($currentItem[$key]))
                 && $nextKey) {
                // If not the last element create path array
                $currentItem[$key] = array();
            } elseif (!$nextKey) {
                $currentItem[$key] = $value;
            }

            $currentItem = &$currentItem[$key];
        }

        return $this;
    }
}
