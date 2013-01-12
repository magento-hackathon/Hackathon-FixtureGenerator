<?php

interface Hackathon_FixtureGenerator_Model_Generator_Interface
{
    /**
     * In constructor our fixture generator should receive a format string
     *
     * @param $format
     */
    public function __construct($format);

    /**
     * Should generate a string from generator logic
     *
     * @param array $data current item
     *
     * @return string
     */
    public function generate(array $data);

}