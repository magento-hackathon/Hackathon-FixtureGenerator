<?php

class Hackathon_FixtureGenerator_Model_Generator_Random extends Hackathon_FixtureGenerator_Model_Generator_Abstract
{

	public function generate(array $data){
        $generatedValue = 0;

        if (preg_match('/\\{random\:(.*?)[,\:](.*?)\\}/', $this->format, $vars)) {
            $generatedValue = rand($vars[1], $vars[2]);
        }

		return $generatedValue;
	}

}