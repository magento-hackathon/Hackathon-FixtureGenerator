<?php

class Hackathon_FixtureGenerator_Model_Generator_Increment extends Hackathon_FixtureGenerator_Model_Generator_Abstract
{
    /**
     * @var int
     */
    protected $increment;

    /**
     * Class constructor; sets the increment value
     * @param $format
     * @return void
     */
    public function __construct($format)
    {
        $this->format = $format;

        if (preg_match_all('/\\{increment\:(.*)\\}/', $format, $vars)) {
            $increment = $vars[1][0];
            $this->increment = $increment;
        }
    }

    /**
     * Generate the next value
     *
     * @param array $data
     * @return int
     */
    public function generate(array $data)
    {
        $increment = $this->increment;
        $this->increment++;
        return $increment;
    }
}
