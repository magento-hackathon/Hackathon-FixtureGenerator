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
class Hackathon_FixtureGenerator_Test_Model_Processor_Product_Grouped extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var null
     */
    protected $processor = null;

    /**
     *
     */
    protected function setUp()
    {
        $this->processor = Mage::getModel('hackathon_fixturegenerator/processor_product_grouped');
    }

    /**
     * @param array $data
     * @dataProvider dataProvider
     */
    public function testProcess(array $data)
    {
        $dataSet = $this->readAttribute($this, 'dataName');

        $numberOfIterations = (isset($data['number'])) ? $data['number'] : 1;
        $processedData = $this->processor->process($data);

        for ($i = 1; $i <= $numberOfIterations; $i++) {
            $this->assertEquals(
                $this->expected($dataSet)->getData('product_'.$i),
                $processedData[$i-1],
                'Assertation for product ' . $i . ' failed'
            );
        }
    }
}
