<?php

class Hackathon_FixtureGenerator_Model_Generator_Random extends Hackathon_FixtureGenerator_Model_Generator_Abstract {

	public function generate(array $data){
		$explodedString = explode(':', $data[0]);

		$generatedValue = 0;

		if (count($explodedString) == 3){
			$generatedValue = rand($explodedString[1], $explodedString[2]);
		}
		return $generatedValue;
	}

}