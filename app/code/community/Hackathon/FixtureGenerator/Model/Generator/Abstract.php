<?php

/**
 * Abstract generator
 */
abstract class Hackathon_FixtureGenerator_Model_Generator_Abstract
    implements Hackathon_FixtureGenerator_Model_Generator_Interface
{
    protected $format;

    public function __construct($format)
    {
        $this->format = $format;
    }

}