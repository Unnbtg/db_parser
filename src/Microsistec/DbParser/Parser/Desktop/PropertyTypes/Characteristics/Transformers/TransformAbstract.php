<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 30/03/2017
 * Time: 19:28
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Transformers;


abstract class TransformAbstract implements TransformerInterface
{
    protected function extractDefaults($transformed, $defaults)
    {
        $extracted = [];

        foreach ($transformed as $key => $item) {

            $value = array_search($item, $defaults);

            if (!$value) {
                continue;
            }

            $extracted[] = $value;

        }

        return $extracted;
    }
}