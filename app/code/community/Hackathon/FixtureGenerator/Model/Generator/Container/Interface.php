<?php


/**
 * Generator interface for fixture generator
 *
 * Usage:
 *
 * $container = new GeneratorContainer();
 * $container->initialize($stringValue); // {range:1,5,1}|{increment:1}
 * $rows = array();
 * for ($i = 0; $i < $numberOfTimes; $i ++) {
 *    $rows[$i]['attribute'] = $container->generate($rows[$i]);
 * }
 *
 */
interface Hackathon_FixtureGenerator_Model_Generator_Container_Interface
{
    /**
     * @param string $string
     *
     * @return Hackathon_FixtureGenerator_Model_Generator_Container_Interface
     */
    public function initialize($string);

    /**
     * Generates a string with data of row
     *
     * @param array $rowData
     *
     * @return string
     */
    public function generate($rowData);

}