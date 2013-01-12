<?php

abstract class Hackathon_FixtureGenerator_Model_Generator_Abstract
{
    protected $format;

    public function __construct($format)
    {
        $this->format = $format;
    }

    public function generate(array $data)
    {
        $generatedString = $this->format;
        if (preg_match_all('/\\{\\$(.*)\\}/', $this->format, $vars)) {
            foreach ($vars[1] as $index => $variableName) {
                if (isset($data[$variableName])) {
                    $value = $data[$variableName];
                } else {
                    $value = '';
                }

                $generatedString = str_replace($vars[0][$index], $value, $generatedString);
            }
        }
        return $generatedString;
    }
}