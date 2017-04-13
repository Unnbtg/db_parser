<?php

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;

use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\CharacteristicInterface;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Parser;

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 16:06
 */
class House implements CharacteristicInterface
{

    private $types = [
        1 => ['tipo' => 8, 'subtipo' => null, 'feature' => 230 ], //Isolada
        2 => ['tipo' => 8, 'subtipo' => null, 'feature' => 231 ], //Geminada
        3 => ['tipo' => 9, 'subtipo' => null], //Sobrado
        4 => ['tipo' => 8, 'subtipo' => null, 'feature' => 232 ], //Esquina
        5 => ['tipo' => 8, 'subtipo' => 10], //Padrão
        6 => ['tipo' => 8, 'subtipo' => null, 'feature' => 233 ], //Vila
        7 => ['tipo' => 8, 'subtipo' => null, 'feature' => 234 ], //Condomínio Fechado
        8 => ['tipo' => 8, 'subtipo' => 11], //Sobreposta Alta
        9 => ['tipo' => 8, 'subtipo' => 12], //Sobreposta Baixa
        10 => ['tipo' => 8, 'subtipo' => null, 'feature' => 235 ], //Semi Acabada
        11 => ['tipo' => 8, 'subtipo' => 13], //Edícula
        12 => ['tipo' => 8, 'subtipo' => null, 'feature' => 236 ], //Alto Padrão
        13 => ['tipo' => 8, 'subtipo' => 14], //Casa Térrea
        14 => ['tipo' => 8, 'subtipo' => null, 'feature' => 237 ], //Loteamento Fechado
        15 => ['tipo' => 8, 'subtipo' => null], //Kitchinete
        16 => ['tipo' => 8, 'subtipo' => null, 'feature' => 238 ], //Reformada
        17 => ['tipo' => 8, 'subtipo' => null], //Financiamento Direto
        18 => ['tipo' => 8, 'subtipo' => null], //Financiamento Bancário
        19 => ['tipo' => 8, 'subtipo' => null], //Casa p/ Renda
        20 => ['tipo' => 8, 'subtipo' => null, 'feature' => 239 ], //Vilagio
        21 => ['tipo' => 8, 'subtipo' => 15], //Duplex
        22 => ['tipo' => 8, 'subtipo' => 16], //Triplex
        23 => ['tipo' => 8, 'subtipo' => null, 'feature' => 30 ], //Frente p/ Mar
        24 => ['tipo' => 8, 'subtipo' => null, 'feature' => 240 ], //Assobradado
    ];

    public function getTypeSubtype($model)
    {
        if($model->definition_01 != ''){

            $definitions = str_split(substr($model->definition_01,0,23));
            $result = null;

             /* preciso ver se ele não é nenhum subtipo q virou tipo
             * percorro as definicoes vejo se eh subtipo null (ou seja, eh um tipo no online)
             * to fazendo key + 1 pq na doc do sci desktop ta o valor da posição começando por 1, soh que array começa em 0
             */
            foreach ($definitions as $key => $value) {
                try {

                    if (is_null($this->types[$key+1]['subtipo']) && $value == 1) {
                        $result['tipo'] = $result['tipo'] != 9 ? $this->types[$key+1]['tipo'] : $result['tipo'];
                        $result['subtipo'] = null;
                        if(isset($this->types[$key+1]['feature'])){
                            $result['feature'][] = $this->types[$key+1]['feature'];

                        }
                    }

                } catch (\Exception $e) {
                    echo $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine() . PHP_EOL;
                    var_dump($model->code, $model->definition_01);exit;
                }

            }

            if(!is_null($result)){
                return $result;
            }

            // se tiver edícula jah retorno
            if (isset($definitions[10]) && $definitions[10] == 1) {
                return $this->types[11];
            }

            // nao tem edicula, vamos la rs
            if (isset($definitions[10]) && $definitions[10] == 0) {

                if (
                    isset($definitions[4]) && $definitions[4] == 1 &&
                    isset($definitions[7]) && $definitions[7] == 1 &&
                    isset($definitions[8]) && $definitions[8] == 1 &&
                    isset($definitions[13]) && $definitions[13] == 1 &&
                    isset($definitions[20]) && $definitions[20] == 1 &&
                    isset($definitions[21]) && $definitions[21] == 1)
                {
                    return $this->types[5];
                }

            }

            if (isset($definitions[7]) && $definitions[7] == 1 &&
                (isset($definitions[12]) && $definitions[12] == 1 || isset($definitions[20]) && $definitions[20] == 1 || isset($definitions[21]) && $definitions[21] == 1) ) {
                return $this->types[8];
            }

            if (isset($definitions[8]) && $definitions[8] == 1 && (isset($definitions[12]) && $definitions[12] == 1 || isset($definitions[20]) && $definitions[20] == 1 || isset($definitions[21]) && $definitions[21] == 1) ) {
                return $this->types[9];
            }

            if ((isset($definitions[7]) && $definitions[7] == 1) && (isset($definitions[8]) && $definitions[8] == 1)) {
                return $this->types[8];
            }
        }

        return $this->types[5];

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
                    'type' => "position",
                    "values" => [
                        1 => "varanda",
                        2 => "lavanderia",
                        3 => "quintal",
                        4 => "churrasqueira",
                        5 => "piscina",
                        6 => "edicula",
                        7 => "terraco",
                        8 => "grades",
                        9 => "muros",
                        10 => "portao-eletronico", //não tem
                        11 => "area-de-servico",
                        12 => "jardim",
                        13 => "salao-de-festas",
                        14 => "sauna", // no desktop eh soh sauna
                        15 => "solarium",
                        16 => "interfone",
                        17 => "central-de-gas",
                        18 => "aquecimento-solar", // não tem
                        19 => "entrada-lateral",
                        20 => "deposito-na-garagem",
                        21 => "sacada",
                        22 => "sacada-panoramica",
                        23 => "forno-de-pizza", // so tem o de pizza e de pao não
                        24 => "gerador-de-emergencia",
                        25 => "garagem-fechada",
                        26 => "piscina-aquecida",
                        27 => "deck-molhado",
                        28 => "parque-aquatico",
                        29 => "salao-de-jogos",
                        30 => "sala-fitness", // no sci online so tem sala-fitness e no desktop soh fitness
                        31 => "quadra-poliesportiva",
                        32 => "quadra-de-volei",
                        33 => "quadra-de-tenis",
                        34 => "espaco-gourmet",
                        35 => "espaco-grill",
                        36 => "playground",
                        37 => "brinquedoteca",
                        38 => "hall-de-entrada", // so hall de entrada no online, no desktop soh tem hall social
                        39 => "office",
                        40 => "cinema",
                        41 => "lan-house",
                        42 => "garage-band",
                        43 => "espaco-mulher",
                        44 => "spa",
                        45 => "atelier",
                        46 => "port-cochere",
                        47 => "mirante",
                        48 => "bangalo",
                        49 => "pergolado", // nao tem e o que demonios é isso??
                        50 => "espaco-zen",
                        51 => "redario",
                        52 => "pista-de-skate",
                        53 => "pista-de-caminhada",
                        54 => "pista-de-bocha",
                        55 => "pet-place",
                        56 => "praca-de-convivencia", //praca da arvore no desktop
                        57 => "pomar",
                        58 => "lago",
                        59 => "lavanderia-coletiva",
                    ]
                ]
            ],
            'room' => [
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