<?php

/**
 * Helper class
 *
 *
 */
class Hackathon_FixtureGenerator_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function updatePathValue($path, $value, &$array)
    {
        $path = preg_split('/(?<!\\\\)\\//', $path);

        $currentItem = &$array;

        for ($i = 0, $length=count($path); $i < $length; $i++) {
            $key = strtr($path[$i], array('\\/' => '/'));
            $nextKey = isset($path[$i+1]) ? $path[$i+1] : false;

            if ((!isset($currentItem[$key])
                    || !is_array($currentItem[$key]))
                 && $nextKey) {
                // If not the last element create path array
                $currentItem[$key] = array();
            } elseif (!$nextKey) {
                $currentItem[$key] = $value;
            }

            $currentItem = &$currentItem[$key];
        }

        return $this;
    }
}
