<?php

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\CharacteristicInterface;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Parser;

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 16:08
 */
class Land implements CharacteristicInterface
{

    private $types = [
        0 => ['tipo' => 11, 'subtipo' => null],  //Simples
        1 => ['tipo' => 1, 'subtipo' => null],  //Incorporação
        2 => ['tipo' => 13, 'subtipo' => null],  //Sítio
        3 => ['tipo' => 14, 'subtipo' => null],  //Fazenda
        4 => ['tipo' => 12, 'subtipo' => null],  //Chácara
        5 => ['tipo' => 10, 'subtipo' => null],  //Loteamento
        6 => ['tipo' => 17, 'subtipo' => null],  //Área Industrial
        7 => ['tipo' => 11, 'subtipo' => null],  //Condomínio Fechado
        8 => ['tipo' => 11, 'subtipo' => null],  //Terreno Residencial
        9 => ['tipo' => 11, 'subtipo' => null],  //Terreno Comercial
        10 => ['tipo' => 11, 'subtipo' => null],  //Empreendimento
        11 => ['tipo' => 17, 'subtipo' => null],  //Área Comercial
        12 => ['tipo' => 17, 'subtipo' => null],  //Área Residencial
        13 => ['tipo' => 17, 'subtipo' => null],  //Área Portuária
        14 => ['tipo' => 17, 'subtipo' => null],  //Área Retroportuária
        15 => ['tipo' => 11, 'subtipo' => null],  //Terreno Industrial
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
                    'field' => 'definition_02',
                    'type' => 'value',
                    'values' => [
                        0 => "arenoso",
                        1 => "argiloso",
                        2 => "terra-roxa",
                        3 => "mangue",
                        4 => "pedregoso",
                        5 => "plano",
                        6 => "declive",
                        7 => "aclive",
                        8 => "leve-declive",
                        9 => "leve-aclive",
                    ]
                ],
                [
                    'type' => 'position',
                    'field' => 'definition_master',
                    'values' => [
                        5 => "rua-asfaltada",
                        "rua-calcada",
                    ]
                ]

            ],
            'proximity' => [
                [
                    'type' => 'position',
                    'field' => 'definition_master',
                    'values' => [
                        1 => "padaria",
                        "supermercado",
                        "ponto-de-onibus",
                        "escola",
                        "rua-asfaltada",
                        "rua-calcada",
                    ]
                ]

            ]
        ];
    }

}