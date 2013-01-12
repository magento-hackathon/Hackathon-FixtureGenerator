<?php

class Hackathon_FixtureGenerator_Model_Generator_Increment extends Hackathon_FixtureGenerator_Model_Generator_Abstract
{
    /**
     * @var int
     */
    protected $increment;

    protected $placeholder;

    /**
     * Class constructor; sets the increment value
     * @param $format
     * @return void
     */
    public function __construct($format)
    {
        $this->format = $format;

        if (preg_match('/\\{increment\:(.*)\\}/', $format, $vars)) {
            $increment = $vars[1];
            $this->increment = $increment;
            $this->placeholder = $vars[0];
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
        $value = str_replace($this->placeholder, $this->increment++, $this->format);
        return $value;
    }
}
