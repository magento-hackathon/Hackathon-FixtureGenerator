<?php
/**
 * ${PROJECT}
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   ${CATEGORY}
 * @package    ${PACKAGE}
 * @copyright  Copyright (c) 2013 EcomDev BV (http://www.ecomdev.org)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Ivan Chepurnyi <ivan.chepurnyi@ecomdev.org>
 */

class Hackathon_FixtureGenerator_Model_Generator_Variable extends Hackathon_FixtureGenerator_Model_Generator_Abstract
{
    public function generate(array $data)
    {
        $generatedString = $this->format;
        if (preg_match_all('/\\{\\$(.*)\\}/', $this->format, $vars)) {
            $replace = array();
            foreach ($vars[1] as $index => $variableName) {
                if (isset($data[$variableName])) {
                    $value = $data[$variableName];
                } else {
                    $value = '';
                }
                $replace[$vars[0][$index]]=$value;
            }

            $generatedString = strtr($generatedString, $replace);
        }
        return $generatedString;
    }
}