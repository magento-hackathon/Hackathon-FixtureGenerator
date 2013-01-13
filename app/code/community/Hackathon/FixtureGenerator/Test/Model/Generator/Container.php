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
class Hackathon_FixtureGenerator_Test_Model_Generator_Container extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Hackathon_FixtureGenerator_Model_Generator_Container
     */
    protected $container = null;

    /**
     * List of generator classes
     *
     * @var string[]
     */
    protected $originalGenerators = array();

    /**
     *
     */
    protected function setUp()
    {
        $this->container = Mage::getModel('hackathon_fixturegenerator/generator_container');
        $this->originalGenerators = EcomDev_Utils_Reflection::getRestrictedPropertyValue(
            'Hackathon_FixtureGenerator_Model_Generator_Container',
            'generators'
        );

        EcomDev_Utils_Reflection::setRestrictedPropertyValue(
            'Hackathon_FixtureGenerator_Model_Generator_Container',
            'generators',
            array()
        );
    }

    /**
     *
     */
    public function testAdd()
    {
        $this->assertAttributeEmpty('generators', 'Hackathon_FixtureGenerator_Model_Generator_Container');

        Hackathon_FixtureGenerator_Model_Generator_Container::add(
            '$', 'Hackathon_FixtureGenerator_Model_Generator_Abstract'
        );
        $this->assertSame(
            array('$' => 'Hackathon_FixtureGenerator_Model_Generator_Abstract'),
            $this->readAttribute($this->container, 'generators')
        );

        Hackathon_FixtureGenerator_Model_Generator_Container::add(
            'range', 'Hackathon_FixtureGenerator_Model_Generator_Range'
        );

        $this->assertSame(
            array(
                '$' => 'Hackathon_FixtureGenerator_Model_Generator_Abstract',
                'range' => 'Hackathon_FixtureGenerator_Model_Generator_Range'
            ),
            $this->readAttribute('Hackathon_FixtureGenerator_Model_Generator_Container', 'generators')
        );
    }

    /**
     *
     */
    public function testRemove()
    {
        EcomDev_Utils_Reflection::setRestrictedPropertyValue(
            'Hackathon_FixtureGenerator_Model_Generator_Container',
            'generators',
            array(
                '$' => 'Hackathon_FixtureGenerator_Model_Generator_Abstract',
                'range' => 'Hackathon_FixtureGenerator_Model_Generator_Range'
            )
        );

        $this->container->remove('$');

        $this->assertArrayNotHasKey('$', $this->readAttribute(
            'Hackathon_FixtureGenerator_Model_Generator_Container',
            'generators'
        ));

        $this->assertArrayHasKey('range', $this->readAttribute(
            'Hackathon_FixtureGenerator_Model_Generator_Container',
            'generators'
        ));

        $this->container->remove('range');
        $this->assertArrayNotHasKey('$', $this->readAttribute(
            'Hackathon_FixtureGenerator_Model_Generator_Container', 'generators'
        ));
        $this->assertArrayNotHasKey('range', $this->readAttribute(
            'Hackathon_FixtureGenerator_Model_Generator_Container', 'generators'
        ));
    }

    /**
     * Tests generators creation
     *
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testInitialize($string)
    {
        $this->assertAttributeEmpty('value', $this->container);
        $this->container->initialize($string);

        /* @var $value Hackathon_FixtureGenerator_Model_Generator_Interface[] */
        $value = $this->readAttribute($this->container, 'value');

        $expected = $this->expected()->getData($string);
        foreach ($value as $index => $generator) {
            if (is_string($generator)) {
                $this->assertEquals($expected[$index], $generator);
            } else {
                $this->assertInstanceOf($expected[$index], $generator);
            }
        }
    }

    /**
     * Tests generators creation
     *
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testGenerate($string, $data)
    {
        $this->container->initialize($string);

        foreach ($this->expected()->getData($string) as $expectedValue) {
            $this->assertEquals($expectedValue, $this->container->generate($data));
        }
    }

    /**
     * Test initialize generators
     */
    public function testInitializeGenerators()
    {
        $this->assertAttributeEmpty('generators', 'Hackathon_FixtureGenerator_Model_Generator_Container');
        Hackathon_FixtureGenerator_Model_Generator_Container::initializeGenerators();
        $generators = $this->readAttribute('Hackathon_FixtureGenerator_Model_Generator_Container', 'generators');
        $this->assertEquals(
            array(
                '$' => 'Hackathon_FixtureGenerator_Model_Generator_Variable',
                'increment' => 'Hackathon_FixtureGenerator_Model_Generator_Increment',
                'range' => 'Hackathon_FixtureGenerator_Model_Generator_Range',
                'random' => 'Hackathon_FixtureGenerator_Model_Generator_Random'
            ),
            $generators
        );
    }

    /**
     *
     */
    protected function tearDown()
    {
        EcomDev_Utils_Reflection::setRestrictedPropertyValue(
            'Hackathon_FixtureGenerator_Model_Generator_Container',
            'generators',
            $this->originalGenerators
        );
    }
}
