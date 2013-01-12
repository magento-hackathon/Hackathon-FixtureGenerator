<?php

class Hackathon_FixtureGenerator_Model_Generator_Range extends Hackathon_FixtureGenerator_Model_Generator_Abstract 
{
	protected $format;
	protected $range;
	
	public function __construct($format)
	{
		$this->format = $format;
		
        if (preg_match_all('/\\{range\:(.*)\,(.*),(.*)\\}/', $format, $vars)) {
        	$from = $vars[1][0];
			$to = $vars[2][0];
			$step = $vars[3][0];
			$this->range = range($from,$to,$step);
		}
	}
	
	public function generate(array $data) {
		$next = current($this->range);
		
		if (next($this->range) === false) {
			reset($this->range);
		}
		
		return $next;
	}

}
