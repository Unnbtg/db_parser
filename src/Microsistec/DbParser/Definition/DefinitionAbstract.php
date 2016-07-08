<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 04/07/16
 * Time: 09:52
 */

namespace Microsistec\DbParser\Definition;

class DefinitionAbstract
{

    /**
     *
     * Returns which options are available on the given options, following the SCI convention.
     *
     * if the string is 1 then it's true.
     * if the string is - then it's false.
     *
     * That is used for each position, so the return must use it's keys to be able to parse the correct results.
     *
     * @param $options
     * @return array
     */
    protected function getActiveDefinitions($options)
    {
        $array = str_split($options);
        return array_filter($array, 'strtolower');
    }


    protected function massAssignment($keys, $options)
    {
        foreach ($options as $key => $value) {
            $propertyName = $options[$key];

            if ( isset($this->$propertyName)  && $this->$propertyName == true) {
                continue;
            }
            $this->$propertyName = isset($keys[$key]) && $keys[$key] != "0";
        }
    }

}