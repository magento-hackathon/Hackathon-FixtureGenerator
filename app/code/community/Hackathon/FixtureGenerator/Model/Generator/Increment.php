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
class Hackathon_FixtureGenerator_Model_Generator_Increment extends Hackathon_FixtureGenerator_Model_Generator_Abstract
{
    /**
     * @var int
     */
    protected $increment;

    /**
     * @var string
     */
    protected $placeholder;

    /**
     * Class constructor; sets the increment value
     * @param $format
     * @return void
     */
    public function __construct($format)
    {
        $this->format = $format;

        if (preg_match('/\\{increment\:(.*)\\}/', $format, $vars)) {
            $increment = $vars[1];
            $this->increment = $increment;
            $this->placeholder = $vars[0];
        }
    }

    /**
     * Generate the next value
     *
     * @param array $data
     * @return int
     */
    public function generate(array $data)
    {
        $value = str_replace($this->placeholder, $this->increment++, $this->format);
        return $value;
    }
}
