<?php

class Hackathon_FixtureGenerator_Test_Model_Processor_Abstract
    extends EcomDev_PHPUnit_Test_Case
{
    /**
     * @var Hackathon_FixtureGenerator_Model_Processor_Abstract
     */
    protected $processor;

    /**
     *
     */
    protected function setUp()
    {
        $this->processor = $this->getMockForAbstractClass('Hackathon_FixtureGenerator_Model_Processor_Abstract');
    }

    /**
     *
     *
     * @param $type
     * @dataProvider dataProvider
     */
    public function testGetConfigPath($type)
    {
        EcomDev_Utils_Reflection::setRestrictedPropertyValue($this->processor, 'type', $type);
        $this->assertEquals(
            $this->expected()->getData($type),
            $this->processor->getConfigPath()
        );
    }

    /**
     *
     * @param string $type
     * @param string $attribute
     * @dataProvider dataProvider
     * @loadFixture config
     */
    public function testGetDefaultValue($type, $attribute)
    {
        EcomDev_Utils_Reflection::setRestrictedPropertyValue($this->processor, 'type', $type);

        $this->assertEquals(
            $this->expected($type)->getData($attribute),
            $this->processor->getDefaultValue($attribute)
        );
    }

    /**
     * @param $requiredKeys
     * @dataProvider dataProvider
     */
    public function testGetRequiredKeys($requiredKeys)
    {
        EcomDev_Utils_Reflection::setRestrictedPropertyValue($this->processor, 'requiredKeys', $requiredKeys);
        $this->assertSame($requiredKeys, $this->processor->getRequiredKeys());
    }

    /**
     *
     *
     * @param string $type
     * @param array $requiredKeys
     * @dataProvider dataProvider
     * @loadFixture config
     */
    public function testGetDefaultData($type, $requiredKeys)
    {
        EcomDev_Utils_Reflection::setRestrictedPropertyValue($this->processor, 'requiredKeys', $requiredKeys);
        EcomDev_Utils_Reflection::setRestrictedPropertyValue($this->processor, 'type', $type);

        $dataSet = $this->readAttribute($this, 'dataName');

        $this->assertEquals($this->expected($dataSet)->getData(), $this->processor->getDefaultData());
    }

    /**
     * Test that attribute data was initialized
     *
     * @param string[] $data
     * @dataProvider dataProvider
     */
    public function testInitialize($data)
    {
        $generatorMock = $this->getModelMock('hackathon_fixturegenerator/generator_container');
        $generatorMock->expects($this->exactly(count($data)))
                ->method('initialize')
                ->with($this->logicalNot($this->isEmpty()))
                ->will($this->returnSelf());

        $this->replaceByMock('model', 'hackathon_fixturegenerator/generator_container', $generatorMock);

        $this->processor->initialize($data);
    }

    /**
     * Test that attribute data was initialized
     *
     * @param string[] $data
     * @dataProvider dataProvider
     */
    public function testGenerate($data)
    {
        $generatorMock = $this->getModelMock('hackathon_fixturegenerator/generator_container');
        $generatorMock->expects($this->exactly(count($data)))
            ->method('generate')
            ->with($this->logicalNot($this->isEmpty()))
            ->will($this->returnSelf());

        $this->replaceByMock('model', 'hackathon_fixturegenerator/generator_container', $generatorMock);

        $this->processor->initialize($data);
        $this->processor->generate($data);
    }

}