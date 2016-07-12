<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 10:57
     */

    namespace Microsistec\DbParser\Definition;


    class OldMasSAssignment implements MassAssignmentable
    {
        public function massAssignment($object, $toConvert, $options)
        {
            if (is_null($toConvert)) {
                $toConvert = $this->activeOptions($options);
            }

            foreach ($options as $key => $value) {
                $propertyName = $options[$key];

                if ( isset($object->$propertyName)  && $object->$propertyName == true) {
                    continue;
                }
                $object->$propertyName = isset($toConvert[$key]) && $toConvert[$key] != "0";
            }
        }

        function activeOptions($options = null)
        {
            $array = str_split($options);
            return array_filter($array, 'strtolower');
        }


    }