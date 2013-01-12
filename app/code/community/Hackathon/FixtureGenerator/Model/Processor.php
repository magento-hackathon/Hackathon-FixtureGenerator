<?php

class Hackathon_FixtureGenerator_Model_Processor implements EcomDev_PHPUnit_Model_Fixture_Processor_Interface
{
    /**
     * Applies data from fixture file
     *
     * @param array[]                                 $data
     * @param string                                  $key
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     *
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function apply(array $data, $key, EcomDev_PHPUnit_Model_Fixture_Interface $fixture)
    {
        
    }

    /**
     * Discards data from fixture file
     *
     * @param array[]                                 $data
     * @param string                                  $key
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     *
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function discard(array $data, $key, EcomDev_PHPUnit_Model_Fixture_Interface $fixture)
    {

    }

    /**
     * Initializes fixture processor before applying data
     *
     * @param EcomDev_PHPUnit_Model_Fixture_Interface $fixture
     * @return EcomDev_PHPUnit_Model_Fixture_Processor_Interface
     */
    public function initialize(EcomDev_PHPUnit_Model_Fixture_Interface $fixture)
    {

    }
}
