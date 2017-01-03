<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 11:06
 */

namespace Microsistec\DbParser;


class AbstractParsedType
{
    const ADD = 'add';

    protected $requirements = [];

    public function addRequeriments($function, $params, $type = null) {
        $this->requirements[] = ['fuction' => $function, 'params' => $params, 'type' => $type];
    }

    public function getRequeriments()
    {
        return $this->requirements;
    }

    public function toArray()
    {
        $array = [];
        foreach ($this as $key => $value) {
            if (is_scalar($value)) {
                $array[$key] = $value;
            }

            if ($value instanceof AbstractParsedType ) {
                $array[$key] = $value->toArray();
            }
        }

        return $array;
    }
}