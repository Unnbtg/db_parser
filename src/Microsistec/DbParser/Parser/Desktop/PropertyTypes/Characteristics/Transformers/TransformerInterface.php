<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 16:53
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Transformers;


interface TransformerInterface
{
    /**
     * @param string $values The values that need to be transformed.
     * @param array $base array of information needed to transform.
     * @param array $options  modifiers in the transform process, it may be required depending of the transform.
     * @param array $defaults The values that must be used as alias after the transformations
     * @return array the result of the transformation.
     */
    public function transform($values, $base, $defaults, $options = []);
}