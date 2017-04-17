<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 29/03/17
 * Time: 12:23
 */

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;


use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\CharacteristicInterface;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Parser;

class Rural implements CharacteristicInterface
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
        if ($model->definition_01 != '') {
            return $this->types[$model->definition_01];
        }
    }

    public function getFeatures($model)
    {
        $parser = new Parser();

        return $parser->parse($model, $this);
    }

    public function getParserInformation()
    {
        return [
            'features' => [
                [
                    'field'  => 'definition_02',
                    'type'   => 'position',
                    'values' => [
                        1  => "casa-de-caseiro",
                        2  => "salao-de-festas",
                        3  => "capela",
                        4  => "curral",
                        5  => "paiol",
                        6  => "redondel",
                        7  => "estabulo",
                        8  => "galpao",
                        9  => "cocheira",
                        10 => "piquete",
                        11 => "tuia",
                        12 => "terreiros-de-cafe",
                        13 => "silos-de-graos",
                        14 => "mangueira",
                    ],
                ],
                [
                    'field'  => 'definition_03',
                    'type'   => 'position',
                    'values' => [
                        1  => "portal-de-entrada",
                        2  => "cerca-arame-liso",
                        3  => "cerca-regua",
                        4  => "cerca-arame-farpado",
                        5  => "guarita",
                        6  => "asfalto",// tem rua asfaltada... acredito que seja a mesma coisa.
                        7  => "sem-calcamento",//nope
                        8  => "pedregulho",//nope
                        9  => "paralelepipedo",//nope
                        10 => "cerca-eletrica",
                        11 => "circuito-de-seguranca"// no desktop eh sistema de segurança
                    ],
                ],
                [
                    'field'  => 'definition_master',
                    'type'   => 'position',
                    'values' => [
                        1 => "playground",
                        "salao-de-jogos",
                        "campos-de-futebol",
                        "churrasqueira",
                        "fogao-a-lenha",
                        "forno-de-pizza",
                        "sala-de-ginastica",
                        "sauna-seca-/-umida", // nos temos as duas separadas não juntas
                        "quadra-poliesportiva",
                        "piscina",
                        "jardim",
                        "pomar",
                        "horta",
                        "cachoeira",
                        "mata-nativa",
                        "nascente",
                        "pecuaria-(leite)",
                        "pecuaria-(corte)",
                        "avicultura",
                        "suinocultura",
                        "equinocultura",
                        "ovicultura",
                        "piscicultura",
                        "ranario",
                        "avestruz",
                        "granja",
                        "plantacao-de-cana",
                        "plantacao-de-cafe",
                        "plantacao-de-soja",
                        "plantacao-de-milho",
                        "plantacao-de-laranja",
                        "hortalicas",
                        "energia-publica",
                        "gerador-proprio",
                        "rede-publica",
                        "poco-artesiano",
                        "poco-semi-artesiano",
                        "poco-caipira",
                        "mina",
                        "corrego",
                    ],
                ],
            ],
        ];
    }

}
