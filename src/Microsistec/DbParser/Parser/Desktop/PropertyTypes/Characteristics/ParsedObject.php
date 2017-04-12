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
    public $features = [];
    public $rooms = [];

    public function addFeatures($features)
    {
        if (is_array($features)) {
            $this->features = array_merge($this->features, $features);
        }

        sort($this->features);
    }

    public function addFeature($feature_id)
    {
        $this->addFeatures([$feature_id]);
    }

    public function addProximity($proximity)
    {
        if (is_array($proximity)) {
            $this->proximities = array_merge($this->proximities, $proximity);
        }
    }

    public function addRoom($room)
    {
        if (is_array($room)) {
            $this->rooms = array_merge($this->rooms, $room);
        }
    }
}