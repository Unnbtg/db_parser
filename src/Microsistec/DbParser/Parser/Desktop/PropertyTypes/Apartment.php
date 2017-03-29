<?php

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 15:57
 */
class Apartment
{
    private $types = [
        1 => ['tipo' => 1, 'subtipo' => 5], //Padrão
        2 => ['tipo' => 4, 'subtipo' => null], //Kitchinete
        3 => ['tipo' => 2, 'subtipo' => null], //Cobertura
        4 => ['tipo' => 1, 'subtipo' => 2, 'is' => [ ['condition' => ['definition_01' => 3], 'subtipo' => 8]] ], //Duplex
        5 => ['tipo' => 1, 'subtipo' => 7, 'is' => [ ['condition' => ['definition_01' => 3], 'subtipo' => 9]] ], //Triplex
        6 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999] ], //Alto Padrão
        7 => ['tipo' => 1, 'subtipo' => 1], //1 por andar
        8 => ['tipo' => 3, 'subtipo' => null], //Flat
        9 => ['tipo' => 37, 'subtipo' => null], //Sala Living
        10 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999] ], //Médio
        11 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999] ], //Grande
        12 => ['tipo' => 1, 'subtipo' => 6], //Térreo
        13 => ['tipo' => 6, 'subtipo' => null], //Loft
        14 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999]], //Vista p/ Mar
        15 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999]], //Reformado
        16 => ['tipo' => 1, 'subtipo' => null], //Financiamento Direto
        17 => ['tipo' => 1, 'subtipo' => null], //Financiamento Bancário
        18 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999]], //Sem Condomínio
        19 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999]], //Frente p/ Mar
        20 => ['tipo' => 7, 'subtipo' => null], //Studio
        21 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999]], //Tipo Casa
        22 => ['tipo' => 1, 'subtipo' => null, 'feature' => [999]], //De Campo
        23 => ['tipo' => 5, 'subtipo' => null], //Penthouse
        24 => ['tipo' => 1, 'subtipo' => 3], //Garden
        25 => ['tipo' => 1, 'subtipo' => 4], //Garden Elevado
    ];

    public function getTypeSubtype($model)
    {
        $tmp = str_split($model->definition_01);

        if ($tmp[1] == 1){
            return $this->types[11];
        }

        return $this->types[1];

    }

}