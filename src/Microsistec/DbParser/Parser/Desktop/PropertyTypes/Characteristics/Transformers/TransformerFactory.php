<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 17:39
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Transformers;


class TransformerFactory
{

    public static $transformers = [
        'position' => PositionTransformer::class,
        'value'    => ValueTransformer::class,
        'patterns' => PatternTransformer::class
    ];


    /**
     * @param $name
     * @return TransformerInterface
     */
    public static function create($name) {
        return new TransformerFactory::$transformers[$name];
    }
}