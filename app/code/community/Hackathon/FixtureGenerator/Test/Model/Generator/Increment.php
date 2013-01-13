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
class Hackathon_FixtureGenerator_Test_Model_Generator_Increment extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var null
     */
    protected $generator = null;

    /**
     *
     */
    protected function setUp()
    {

    }

    /**
     * @param array $currentRow
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testGenerate(array $currentRow, $string, $numberOfIterations)
    {
        $this->generator = $this->getMockForAbstractClass('Hackathon_FixtureGenerator_Model_Generator_Increment', array($string));
        $dataSet = $this->readAttribute($this, 'dataName');
        for ($i = 0; $i < $numberOfIterations; $i++) {
            $this->assertEquals(
                $this->expected($dataSet)->getData('iteration_' . $i),
                $this->generator->generate($currentRow),
                'Assertation ' . $i . ' failed'
            );
        }
    }
}
