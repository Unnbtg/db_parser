<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 16:46
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Transformers;


class PositionTransformer extends TransformAbstract
{
    public function transform($values, $base, $defaults, $options = [])
    {
        $exploded = str_split($values);
        $filtered = [];

        foreach ($exploded as $key => $value) {
            if (!$value || !isset($base[$key + 1])) {
                continue;
            }

            $filtered[] = $base[$key + 1];
        }

        return $this->extractDefaults($filtered, $defaults);
    }




}