<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 16:45
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics;


use Microsistec\DbParser\Parser\Desktop\Dictionaries\CharacteristicsDictionary;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Transformers\TransformerFactory;

class Parser
{

    /**
     * @param $model The model that has to be parsed
     * @param CharacteristicInterface $source The information source for the parser work with.
     * @return ParsedObject Always returns a ParsedObject even if it's fails, in that case all properties will be empty.
     */
    public function parse($model, /*CharacteristicInterface*/ $source = [])
    {
        $base = $source;

        if (!is_array($source)) {
            $base = $source->getParserInformation();
        }

        $parsedObject = new ParsedObject();

        $this->extract($parsedObject, $base['features'], CharacteristicsDictionary::SciOnline["features"], $model, 'features');

        if (isset($base['proximity'])) {
            $this->extract($parsedObject, $base['proximity'], CharacteristicsDictionary::SciOnline["proximity"], $model, 'proximity');
        }

        if (isset($base['room'])) {
            $this->extract($parsedObject, $base['room'], CharacteristicsDictionary::SciOnline["room"], $model, 'room');
        }

        return $parsedObject;
    }


    private function extract($parsedObject, $values, $defaults, $model, $toAdd)
    {

        foreach ($values as $iterator) {
            $transform = TransformerFactory::create($iterator["type"]);
            $options = isset($iterator['options']) ? $iterator['options'] : [];
            $transformed = $transform->transform($model->{$iterator['field']}, $iterator['values'], $defaults['options'], $options);
            $this->add($parsedObject, $toAdd, $transformed);
        }
    }

    private function add($to, $how, $what) {

        switch ($how) {
            case "features":
                $how = "addFeatures";
                break;
            case "proximity":
                $how = "addProximity";
                break;
            case "room":
                $how = 'addRoom';
                break;
            default:
                throw new \Exception("FON!");
        }

        $to->{$how}($what);
    }


}