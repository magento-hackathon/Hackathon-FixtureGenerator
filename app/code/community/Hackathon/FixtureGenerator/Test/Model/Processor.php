<?php

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
}