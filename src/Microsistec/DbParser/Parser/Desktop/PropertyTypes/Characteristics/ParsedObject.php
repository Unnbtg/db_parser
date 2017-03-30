<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 16:48
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics;


class ParsedObject
{

    public $proximities = [];
    public $property = [];
    public $rooms = [];

    public function addProperty($property) {
        $this->property = array_merge($this->property, $property);
    }
    public function addProximity($proximity) {
        $this->proximities = array_merge($this->proximities, $proximity);
    }
    public function addRoom($room) {
        $this->rooms = array_merge($this->rooms, $room);
    }
}