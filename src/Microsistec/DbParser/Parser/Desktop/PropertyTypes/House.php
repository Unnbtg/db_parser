<?php

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 16:06
 */
class House
{
    private $types = [
        1 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['isolada'] ], //Isolada
        2 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['geminada'] ], //Geminada
        3 => ['tipo' => 9, 'subtipo' => null], //Sobrado
        4 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['esquina'] ], //Esquina
        5 => ['tipo' => 8, 'subtipo' => 10], //Padrão
        6 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['vila'] ], //Vila
        7 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['condfechado'] ], //Condomínio Fechado
        8 => ['tipo' => 8, 'subtipo' => 11], //Sobreposta Alta
        9 => ['tipo' => 8, 'subtipo' => 12], //Sobreposta Baixa
        10 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['semiacabada'] ], //Semi Acabada
        11 => ['tipo' => 8, 'subtipo' => 13], //Edícula
        12 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['altopadrao'] ], //Alto Padrão
        13 => ['tipo' => 8, 'subtipo' => 14], //Casa Térrea
        14 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['lotfechado'] ], //Loteamento Fechado
        15 => ['tipo' => 8, 'subtipo' => null], //Kitchinete
        16 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['reformada'] ], //Reformada
        17 => ['tipo' => 8, 'subtipo' => null], //Financiamento Direto
        18 => ['tipo' => 8, 'subtipo' => null], //Financiamento Bancário
        19 => ['tipo' => 8, 'subtipo' => null], //Casa p/ Renda
        20 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['vilagio'] ], //Vilagio
        21 => ['tipo' => 8, 'subtipo' => 15], //Duplex
        22 => ['tipo' => 8, 'subtipo' => 16], //Triplex
        23 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['ftemar'] ], //Frente p/ Mar
        24 => ['tipo' => 8, 'subtipo' => null, 'feature' => ['assobradado'] ], //Assobradado
    ];

    public function getTypeSubtype($model)
    {
        $definitions = str_split(substr($model->definition_01,0,23));
        $result = null;

        /* preciso ver se ele não é nenhum subtipo q virou tipo
         * percorro as definicoes vejo se eh subtipo null (ou seja, eh um tipo no online)
         * to fazendo key + 1 pq na doc do sci desktop ta o valor da posição começando por 1, soh que array começa em 0
         */
        foreach ($definitions as $key => $value) {
            try {

                if(is_null($this->types[$key+1]['subtipo']) && $value == 1) {
                    $result['tipo'] = $this->types[$key+1]['tipo'];
                    $result['subtipo'] = null;
                    $result['feature'][] = isset($this->types[$key+1]['feature']) ? $this->types[$key+1]['feature'] : '';
                }

            } catch (\Exception $e) {
                var_dump($model->code, $model->definition_01);exit;
            }

        }

        if(!is_null($result)){
            return $result;
        }

        // se tiver edícula jah retorno
        if ($definitions[10] == 1) {
            return $this->types[11];
        }

        // nao tem edicula, vamos la rs
        if ($definitions[10] == 0) {

            if ($definitions[4] == 1 &&
                $definitions[7] == 1 &&
                $definitions[8] == 1 &&
                $definitions[13] == 1 &&
                $definitions[20] == 1 &&
                $definitions[21] == 1)
            {
                return $this->types[5];
            }

        }

        if ($definitions[7] == 1 && ($definitions[12] == 1 || $definitions[20] == 1 || $definitions[21] == 1) ) {
            return $this->types[8];
        }

        if ($definitions[8] == 1 && ($definitions[12] == 1 || $definitions[20] == 1 || $definitions[21] == 1) ) {
            return $this->types[9];
        }

        if ($definitions[7] == 1 && $definitions[8] == 1) {
            return $this->types[8];
        }

        return $this->types[5];

    }
}