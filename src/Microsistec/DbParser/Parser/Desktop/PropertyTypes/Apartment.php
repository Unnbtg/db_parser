<?php

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 15:57
 */
class Apartment
{
    public function isValid($model)
    {
        return $model->type == 1;
    }

    public function getType($model)
    {
        return 1;
    }

    public function getSubtype($model)
    {
        return null;
    }
}