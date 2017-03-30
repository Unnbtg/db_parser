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
        4 => ['tipo' => 1, 'subtipo' => 2], //Duplex
        5 => ['tipo' => 1, 'subtipo' => 7], //Triplex
        6 => ['tipo' => 1, 'subtipo' => null, 'feature' => [236] ], //Alto Padrão
        7 => ['tipo' => 1, 'subtipo' => 1], //1 por andar
        8 => ['tipo' => 3, 'subtipo' => null], //Flat
        9 => ['tipo' => 37, 'subtipo' => null], //Sala Living
        10 => ['tipo' => 1, 'subtipo' => null], //Médio (vira padrao)
        11 => ['tipo' => 1, 'subtipo' => null], //Grande (vira padrao)
        12 => ['tipo' => 1, 'subtipo' => 6], //Térreo
        13 => ['tipo' => 6, 'subtipo' => null], //Loft
        14 => ['tipo' => 1, 'subtipo' => null, 'feature' => [94]], //Vista p/ Mar
        15 => ['tipo' => 1, 'subtipo' => null, 'feature' => [238]], //Reformado
        16 => ['tipo' => 1, 'subtipo' => null], //Financiamento Direto
        17 => ['tipo' => 1, 'subtipo' => null], //Financiamento Bancário
        18 => ['tipo' => 1, 'subtipo' => null, 'feature' => [204]], //Sem Condomínio
        19 => ['tipo' => 1, 'subtipo' => null, 'feature' => [30]], //Frente p/ Mar
        20 => ['tipo' => 7, 'subtipo' => null], //Studio
        21 => ['tipo' => 1, 'subtipo' => null, 'feature' => [241]], //Tipo Casa
        22 => ['tipo' => 1, 'subtipo' => null, 'feature' => [242]], //De Campo
        23 => ['tipo' => 5, 'subtipo' => null], //Penthouse
        24 => ['tipo' => 1, 'subtipo' => 3], //Garden
        25 => ['tipo' => 1, 'subtipo' => 4], //Garden Elevado
        26 => ['tipo' => 2, 'subtipo' => 8], //Cobertura duplex
        27 => ['tipo' => 2, 'subtipo' => 9], //Cobertura triplex
    ];

    public function getTypeSubtype($model)
    {
        $definitions = str_split(substr($model->definition_01,0,24));
        $result = null;

        /**
         * se tiver todos os subtipos que naum saum tipos, retorno cobertura triplex
         * afinal, eh o subtipo mais top de todos
         */
        if (
            isset($definitions[0]) && $definitions[0] == 1 &&
            isset($definitions[3]) && $definitions[3] == 1 &&
            isset($definitions[4]) && $definitions[4] == 1 &&
            isset($definitions[6]) && $definitions[6] == 1 &&
            isset($definitions[11]) && $definitions[11] == 1 &&
            isset($definitions[23]) && $definitions[23] == 1 &&
            isset($definitions[24]) && $definitions[24] == 1)
        {
            return $this->types[27];
        }

        /**
         * cobertura duplex
         */
        if($definitions[2] && $definitions[3]) {
            return $this->types[26];
        }

        /**
         * se tiver duplex e triplex, retorna cobertura triplex
         */
        if($definitions[2] && ($definitions[3] && $definitions[4])) {
            return $this->types[27];
        }

        /**
         * cobertura triplex
         */
        if($definitions[2] && $definitions[4]) {
            return $this->types[27];
        }

        /**
         * se tiver cobertura, jah retorno
         */
        if($definitions[2]) {
            return $this->types[3];
        }

        foreach ($definitions as $key => $value) {

            if (is_null($this->types[$key+1]['subtipo']) && $value == 1) {
                $result['tipo'] = !isset($result['tipo']) ? $this->types[$key+1]['tipo'] : $result['tipo'];
                $result['subtipo'] = null;

                if ($this->types[$key+1]['tipo'] == 1) {
                    $result['subtipo'] = 5;
                }

                $result['feature'][] = isset($this->types[$key+1]['feature']) ? $this->types[$key+1]['feature'] : '';
            }

        }

        if (!is_null($result)) {
            return $result;
        }

        return $this->types[1];

    }

}