<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 18:17
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Transformers;


class ValueTransformer  extends TransformAbstract
{
    public function transform($values, $base, $defaults, $options = [])
    {
        if (isset($base[$values])) {
            return $this->extractDefaults([$base[$values]], $defaults);
        }

        return false;
    }


}