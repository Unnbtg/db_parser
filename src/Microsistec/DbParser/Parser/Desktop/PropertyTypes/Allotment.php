<?php

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 16:08
 */
class Allotment
{
    public function isValid($model)
    {
        return $model->type == 2;
    }
}