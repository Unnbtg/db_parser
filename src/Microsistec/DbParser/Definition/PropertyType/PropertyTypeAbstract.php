<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 04/07/16
     * Time: 15:40
     */

    namespace Microsistec\DbParser\Definition\PropertyType;


    use Microsistec\DbParser\Definition\DefinitionAbstract;

    abstract class PropertyTypeAbstract extends DefinitionAbstract
    {


        public $bedroom;
        public $suite;
        public $bathroom;
        public $room;
        public $kitchen;
        public $garage_lots;
        public $housekeeper_room;
        public $service_area;
        public $lavatory;


        protected abstract function getSubtypesOptions();
        protected abstract function getCharacteristics($options);
        public abstract function getTypeName();


        public function getSubtype($options)
        {
            $pos = strpos($options, '1');
            if ($pos === false) {
                return 'sem_subtipo';
            }
            return $this->getSubtypesOptions()[$pos];
        }

        public function extractLabelsFlagsSci($flagSequence, $possibilities)
        {
            $labels = array();


            foreach ($possibilities as $key => $possibility) {

                if (isset($flagSequence[$key]) && $flagSequence[$key]) {
                    $labels[] = $possibility;
                }
            }

            return $labels;
        }


    }