<?php

interface Hackathon_FixtureGenerator_Model_Processor_Interface
{
    /**
     * Process the given data
     *
     * @param array $data
     * @return mixed
     */
    public function process(array $data);
}
