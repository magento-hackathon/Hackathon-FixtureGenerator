<?php

class Hackathon_FixtureGenerator_Model_Generator_Container
    implements Hackathon_FixtureGenerator_Model_Generator_Container_Interface
{
    protected static $generators = array();

    /**
     * Generator values
     *
     * @var Hackathon_FixtureGenerator_Model_Generator_Interface[]
     */
    protected $value = array();


    /**
     * Adds processor class
     *
     * @param string $type
     * @param string $className
     */
    public static function add($type, $className)
    {
        self::$generators[$type] = $className;
    }

    /**
     * Removes processor by type
     *
     * @param string $type
     */
    public static function remove($type)
    {
        if (isset(self::$generators[$type])) {
            unset(self::$generators[$type]);
        }
    }

    /**
     * Initializes string generators
     *
     *
     */
    public static function initializeGenerators()
    {
        if (empty(self::$generators)) {
            self::add('$', 'Hackathon_FixtureGenerator_Model_Generator_Variable');
            self::add('increment', 'Hackathon_FixtureGenerator_Model_Generator_Increment');
            self::add('random', 'Hackathon_FixtureGenerator_Model_Generator_Random');
            self::add('range', 'Hackathon_FixtureGenerator_Model_Generator_Range');
        }
    }

    /**
     * @param string $string
     *
     * @return Hackathon_FixtureGenerator_Model_Generator_Container
     */
    public function initialize($string)
    {
        self::initializeGenerators();
        $unParsedValue = preg_split('/(?<!\\\\)\\|/', $string);
        foreach ($unParsedValue as $item) {
            $item = strtr($item, array('\\|' => '|'));
            foreach (self::$generators as $type => $className) {
                if (strpos($item, '{' . $type) !== false) {
                    $this->value[] = new $className($item);
                    continue 2;
                }
            }
            $this->value[] = $item;
        }
        return $this;
    }

    /**
     * Generates a string with data of row
     *
     * @param array $data
     *
     * @return string
     */
    public function generate($data)
    {
        $result = '';
        foreach ($this->value as $generator) {
            if ($generator instanceof Hackathon_FixtureGenerator_Model_Generator_Interface) {
                $result .= $generator->generate($data);
            } else {
                $result .= $generator;
            }
        }

        return $result;
    }
}