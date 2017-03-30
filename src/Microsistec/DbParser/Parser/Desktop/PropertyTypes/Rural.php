<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 29/03/17
 * Time: 12:23
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;


class Rural
{

    private $types = [
        0 => ['tipo' => 12, 'subtipo' => null], //Chácara
        1 => ['tipo' => 13, 'subtipo' => null], //Sítio
        2 => ['tipo' => 14, 'subtipo' => null], //Fazenda
        3 => ['tipo' => 15, 'subtipo' => null], //Haras
        4 => ['tipo' => 16, 'subtipo' => null], //Rancho

    ];

    public function getTypeSubtype($model)
    {
        return $this->types[$model->definition_01];
    }
}