<?php

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;

use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\CharacteristicInterface;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Parser;

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 15:57
 */
class Apartment implements CharacteristicInterface
{

    private $types = [
        1 => ['tipo' => 1, 'subtipo' => 5], //Padrão
        2 => ['tipo' => 4, 'subtipo' => null], //Kitchinete
        3 => ['tipo' => 2, 'subtipo' => null], //Cobertura
        4 => ['tipo' => 1, 'subtipo' => 2], //Duplex
        5 => ['tipo' => 1, 'subtipo' => 7], //Triplex
        6 => ['tipo' => 1, 'subtipo' => null, 'feature' => 236 ], //Alto Padrão
        7 => ['tipo' => 1, 'subtipo' => 1], //1 por andar
        8 => ['tipo' => 3, 'subtipo' => null], //Flat
        9 => ['tipo' => 37, 'subtipo' => null], //Sala Living
        10 => ['tipo' => 1, 'subtipo' => null], //Médio (vira padrao)
        11 => ['tipo' => 1, 'subtipo' => null], //Grande (vira padrao)
        12 => ['tipo' => 1, 'subtipo' => 6], //Térreo
        13 => ['tipo' => 6, 'subtipo' => null], //Loft
        14 => ['tipo' => 1, 'subtipo' => null, 'feature' => 94], //Vista p/ Mar
        15 => ['tipo' => 1, 'subtipo' => null, 'feature' => 238], //Reformado
        16 => ['tipo' => 1, 'subtipo' => null], //Financiamento Direto
        17 => ['tipo' => 1, 'subtipo' => null], //Financiamento Bancário
        18 => ['tipo' => 1, 'subtipo' => null, 'feature' => 204], //Sem Condomínio
        19 => ['tipo' => 1, 'subtipo' => null, 'feature' => 30], //Frente p/ Mar
        20 => ['tipo' => 7, 'subtipo' => null], //Studio
        21 => ['tipo' => 1, 'subtipo' => null, 'feature' => 241], //Tipo Casa
        22 => ['tipo' => 1, 'subtipo' => null, 'feature' => 242], //De Campo
        23 => ['tipo' => 5, 'subtipo' => null], //Penthouse
        24 => ['tipo' => 1, 'subtipo' => 3], //Garden
        25 => ['tipo' => 1, 'subtipo' => 4], //Garden Elevado
        26 => ['tipo' => 2, 'subtipo' => 8], //Cobertura duplex
        27 => ['tipo' => 2, 'subtipo' => 9], //Cobertura triplex
    ];

    public function getTypeSubtype($model)
    {
        if($model->definition_01 != ''){

            $definitions = str_split(substr($model->definition_01,0,25));
            $result = null;

            /**
             * se tiver todos os subtipos que naum saum tipos, retorno cobertura triplex
             * afinal, eh o subtipo mais top de todos
             */

            if (
                (isset($definitions[0]) && $definitions[0] == 1) &&
                (isset($definitions[3]) && $definitions[3] == 1) &&
                (isset($definitions[4]) && $definitions[4] == 1) &&
                (isset($definitions[6]) && $definitions[6] == 1) &&
                (isset($definitions[11]) && $definitions[11] == 1) &&
                (isset($definitions[23]) && $definitions[23] == 1) &&
                (isset($definitions[24]) && $definitions[24] == 1))
            {
                return $this->types[27];
            }

            /**
             * cobertura duplex
             */
            if((isset($definitions[2]) && $definitions[2] == 1) && (isset($definitions[3]) && $definitions[3] == 1)) {
                return $this->types[26];
            }

            /**
             * se tiver duplex e triplex, retorna cobertura triplex
             */
            if((isset($definitions[2]) && $definitions[2] == 1) && ((isset($definitions[3]) &&  $definitions[3] == 1) && (isset($definitions[4]) && $definitions[4] == 1))) {
                return $this->types[27];
            }

            /**
             * cobertura triplex
             */
            if((isset($definitions[2]) && $definitions[2] == 1) && (isset($definitions[4]) && $definitions[4] == 1)) {
                return $this->types[27];
            }

            /**
             * se tiver cobertura, jah retorno
             */
            if(isset($definitions[2]) && $definitions[2] == 1) {
                return $this->types[3];
            }

            foreach ($definitions as $key => $value) {

                if (is_null($this->types[$key+1]['subtipo']) && $value == 1) {
                    $result['tipo'] = !isset($result['tipo']) ? $this->types[$key+1]['tipo'] : $result['tipo'];
                    $result['subtipo'] = null;

                    if ($this->types[$key+1]['tipo'] == 1) {
                        $result['subtipo'] = 5;
                    }

                    if(isset($this->types[$key+1]['feature'])){
                        $result['feature'][] = $this->types[$key+1]['feature'];

                    }

                }

            }

            if (!is_null($result)) {
                return $result;
            }
        }

        return $this->types[1];

    }

    public function getFeatures($model)
    {
        $parser = new Parser();
        return $parser->parse($model, $this);
    }

    public function getParserInformation()
    {
        return [
            "features" => [
                [
                    'field' => 'definition_02',
                    'type' => "position",
                    "values" => [
                        1 => "salao-de-festas",
                        2 => "salao-de-jogos",
                        3 => "sala-de-ginastica",
                        4 => "sauna-seca",
                        5 => "parabolica",
                        6 => "tv-assinatura",
                        7 => "solarium",
                        8 => "garage-band",
                        9 => "atelier",
                        10 => "lan-house",
                        11 => "brinquedoteca",
                        12 => "cinema",
                        13 => "espaco-gourmet",
                        14 => "espaco-grill",
                        15 => "spa",
                        16 => "lazer-na-cobertura",
                        17 => "wi-fi",
                        18 => "piscina-da-cobertura",
                        19 => "sauna-umida", //no desktop eh sauna a vapor
                        20 => "jacuzzi"
                    ]
                ],
                [
                    'field' => 'definition_03',
                    'type' => 'position',
                    'values' => [
                        1 => "churrasqueira",
                        2 => "quadra-poliesportiva",
                        3 => "piscina-adulto",
                        4 => "piscina-infantil",
                        5 => "jardim",
                        6 => "servico-de-praia",
                        7 => "playground",
                        8 => "elevador-cadeirante",
                        9 => "entrada-lateral",
                        10 => "deposito-na-garagem",
                        11 => "sacada-panoramica",
                        12 => "forno-de-pizza", // so tem o de pizza o de pão não
                        13 => "gerador-de-emergencia",
                        14 => "quadra-de-tenis",
                        15 => "quadra-de-volei",
                        16 => "piscina-aquecida",
                        17 => "deck-molhado",
                        18 => "parque-aquatico",
                        19 => "mirante",
                        20 => "port-cochere",
                        21 => "pet-place",
                        22 => "pista-de-skate",
                        23 => "pista-de-caminhada",
                        24 => "pista-de-bocha",
                        25 => "bangalo",
                        26 => "espaco-zen",
                        27 => "pergolado",
                        28 => "redario",
                        29 => "praca-de-convivencia", // praça da arvore no desktop
                        30 => "pomar",
                        31 => "lago",
                        32 => "deck-para-barco",
                        33 => "sacada-tecnica",
                    ]
                ],
                [
                    'field' => 'definition_04',
                    'type' => 'position',
                    'values' => [
                        1 => "guarita",
                        2 => "portaria",
                        3 => "portao-eletronico",
                        4 => "cftv", //circuito fechado de tv no desktop
                        5 => "interfone",
                        6 => "alarme-monitorado",
                        7 => "vigia",
                        8 => "vaga-anti-sequestro",
                    ]
                ],
                [
                    'field' => 'definition_05',
                    'type' => 'position',
                    'values' => [
                        1 => "elevador-social",
                        2 => "elevador-de-servico",
                        3 => "hall-de-entrada",
                        4 => "entrada-de-servico",
                        5 => "central-de-gas",
                        6 => "garagem-privativa",
                        7 => "garagem-coletiva", //tem apenas garagem-coletiva...nao indica ser suficiente
                        8 => "garagem-coberta",
                        9 => "sacada",
                        10 => "terraco",
                        11 => "area-de-servico",
                        12 => "garagem-fechada",
                        13 => "garagem-demarcada",
                        14 => "varanda-gourmet",
                        15 => "garagem-escriturada",
                        16 => "office",
                        17 => "espaco-mulher",
                        18 => "lavanderia-coletiva",
                        19 => "bicicletario",
                        20 => "espaco-motos",
                        21 => "elevador-seguranca",
                        22 => "garagem-ar-livre",
                        23 => "manobrista",
                        24 => "telefonia-pabx",
                        25 => "garagem-coletiva-insulficiente",
                        26 => "varanda",
                    ]
                ]
            ],
            "room" => [
                [
                    'field' => 'definition_master',
                    'type' => 'patterns',
                    'values' => [
                        1 => "piso-de-madeira",
                        "piso-frio",
                        "carpete",
                        "ladrilho",
                        "pedra",
                        "granito",
                        "parede-em-alvenaria", // só tem parede em alvenaria
                        "tijolinho",
                        "litoceramica",
                        "azulejo-ate-o-teto",
                        "azulejo-parcial",
                        "parede-com-massa-corrida",
                        "pintura-texturizada",
                        "gesso-moldura",
                        "gesso-rebaixado",
                        "ambiente-em-l",
                        "2-ambientes",
                        "3-ambientes",
                        "cozinha-americana",
                        "copa",
                        "pia",// temos tipos de pia no sci-online, não ela solta.
                        "gabinete",
                        "box-simples",
                        "box-blindex",
                        "closet",
                        "hidromassagem",
                        "janelas-de-madeira",
                        "janelas-de-aluminio",
                        "luminaria",
                        "armario-embutido",
                        "moveis-planejados",
                        "ar-condicionado",
                        "ventilador-de-teto",
                    ],
                    'options' => [
                        'bedroom',
                        'room',
                        'kitchen',
                        'bathroom',
                        'service_area'
                    ]
                ],
                [
                    'field' => 'definition_master',
                    'type' => 'position',
                    'options' => 'others',
                    'values' => [
                        205 => "carpete-de-madeira",
                        "piso-laminado",
                        "piso-porcelanato",
                        "gesso-sanca",
                        "lavabo",//tem não
                        "despensa",
                        "escritorio", // nope
                        "porta-balcao",
                        "cortina-de-vidro",
                        "armarios-individuais",//nope
                        "churrasqueira-na-sacada", //nope
                        "medidores-de-agua-individuais", // nope
                        "lareira",
                        "janela-de-ferro",
                        "contra-piso",
                        "pintura-latex",
                        "servicos-pay-per-use", //nope
                        "deposito-na-garagem", //nope
                        "sistema-de-refrigeracao-central-tipo-sprit", //nope
                        "sistema-de-aquecimento-de-agua-a-gas",//nope
                        "perfil-de-estudantes", //nope
                        "piso-paviflex",
                        "laje", //nope
                        "madeira", //nope
                        "pvc", // nope
                        "wc-empregada", // nope
                        "2-entradas", // nope
                        "piso-ceramica",
                        "piso-marmore",
                        "piso-granito",
                        "papel-de-parede",
                    ]
                ]
            ]
        ];
    }

}