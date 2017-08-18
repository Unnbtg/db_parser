<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 19:05
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Transformers;


class PatternTransformer  extends PositionTransformer
{
    public function transform($values, $base, $defaults, $options = [])
    {
        $fields = [];
        $possibilities = count($base);

        foreach ($options as $key => $field) {

            $toSkip = $key * $possibilities;

            $slice = substr($values, $toSkip, $possibilities);

            $fields[$field] = $this->doTransform($slice, $base, $defaults, []);
        }

        return $fields;
    }

    public function doTransform($values, $base, $defaults, $options = [])
    {
        $exploded = str_split($values);
        $filtered = [];

        foreach ($exploded as $key => $value) {
            if (!$value || !isset($base[$key])) {
                continue;
            }

            $filtered[] = $base[$key];
        }

        if (!empty($options)) {
            return [$options => $filtered];
        }


        return $this->extractDefaults($filtered, $defaults);
    }
}