<?php

class Hackathon_FixtureGenerator_Test_Model_Generator_Range extends EcomDev_PHPUnit_Test_Case
{
    protected $generator = null;

    protected function setUp()
    {

    }

    /**
     *
     *
     * @param array $currentRow
     * @param string $string
     * @dataProvider dataProvider
     */
    public function testGenerate(array $currentRow, $string, $numberOfIteration)
    {
        $this->generator = $this->getMockForAbstractClass('Hackathon_FixtureGenerator_Model_Generator_Range', array($string));
        $dataSet = $this->readAttribute($this, 'dataName');
		for ($i = 1; $i <= $numberOfIteration; $i++) {
			$this->assertEquals(
				$this->expected($dataSet)->getData('iteration_' . $i), 
				$this->generator->generate($currentRow),
				'Assertaion ' . $i . ' failed'
		     );
		}
        
    }
}