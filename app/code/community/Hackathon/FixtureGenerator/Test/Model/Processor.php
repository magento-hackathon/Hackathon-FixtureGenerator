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

class Hackathon_FixtureGenerator_Test_Model_Processor extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Hackathon_FixtureGenerator_Model_Processor
     */
    protected $processor;

    /**
     * @var EcomDev_PHPUnit_Model_Fixture_Processor_Interface|PHPUnit_Framework_MockObject_MockObject
     */
    protected $fixtureMock;

    /**
     *
     */
    protected function setUp()
    {
        $this->processor = Mage::getModel('hackathon_fixturegenerator/processor');
        $this->fixtureMock = $this->getMockForAbstractClass('EcomDev_PHPUnit_Model_Fixture_Interface');
    }

    /**
     * @param array $fixtureData
     *
     * @dataProvider dataProvider
     */
    public function testFixtureBasedGeneration(array $fixtureData)
    {
        $this->fixtureMock->expects($this->any())
            ->method('getFixtureValue')
            ->will($this->returnCallback(function ($key) use (&$fixtureData) {
                if (!isset($fixtureData[$key])) {
                    return array();
                }

                return $fixtureData[$key];
            }));

        $this->fixtureMock->expects($this->any())
            ->method('setFixtureValue')
            ->will($this->returnCallback(function ($key, $value) use (&$fixtureData) {
                $fixtureData[$key] = $value;
            }));

        $this->processor->initialize($this->fixtureMock);

        $this->assertEquals($this->expected('auto')->getFixture(), $fixtureData);
    }

    /**
     * Test real fixture load
     *
     * @loadFixture generate
     * @doNotIndexAll
     */
    public function testRealFixtureLoad()
    {
        /* @var $product Mage_Catalog_Model_Product */
        $product = Mage::getModel('catalog/product');
        foreach ($this->expected()->getProduct() as $productId => $productData) {
            $product->reset();
            $product->load($productId);
            foreach ($productData as $key => $value) {
                $this->assertEquals(
                    $value,
                    $product->getData($key),
                    sprintf('Attribute %s is not match expected value for %s product', $key, $productId)
                );
            }
        }
    }
}