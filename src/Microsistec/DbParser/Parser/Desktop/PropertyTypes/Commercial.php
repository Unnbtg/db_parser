<?php

namespace Microsistec\DbParser\Parser\Desktop\PropertyTypes;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\CharacteristicInterface;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Characteristics\Parser;

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 17:40
 */
class Commercial implements CharacteristicInterface
{

    private $types = [

        0 => ['tipo' => 25, 'subtipo' => null], //Loja
        1 => ['tipo' => 23, 'subtipo' => null], //Sala Comercial
        2 => ['tipo' => 22, 'subtipo' => null], //Galpão Comercial
        3 => ['tipo' => 36, 'subtipo' => 45] , //Consultório
        4 => ['tipo' => 21, 'subtipo' => null] , //Galeria
        5 => ['tipo' => 33, 'subtipo' => null] , //Sobreloja
        6 => ['tipo' => 36, 'subtipo' => 53] , //Escola
        7 => ['tipo' => 36, 'subtipo' => 72] , //Lanchonete
        8 => ['tipo' => 36, 'subtipo' => 113] , //Restaurante
        9 => ['tipo' => 36, 'subtipo' => 112] , //Quiosque
        10 => ['tipo' => 36, 'subtipo' => 123] , //Supermercado
        11 => ['tipo' => 36, 'subtipo' => 95] , //Mini-Mercado
        12 => ['tipo' => 36, 'subtipo' => 100] , //Padaria
        13 => ['tipo' => 24, 'subtipo' => null] , //Salão Comercial
        14 => ['tipo' => 18, 'subtipo' => null] , //Barracão Comercial
        15 => ['tipo' => 19, 'subtipo' => null] , //Conjunto Comercial
        16 => ['tipo' => 36, 'subtipo' => 108] , //Pousada
        17 => ['tipo' => 36, 'subtipo' => 70] , //Hotel
        18 => ['tipo' => 8, 'subtipo' => null] , //Casa Comercial
        19 => ['tipo' => 27, 'subtipo' => null] , //Indústria
        20 => ['tipo' => 30, 'subtipo' => null] , //Prédio Comercial
        21 => ['tipo' => 22, 'subtipo' => null] , //Galpão Industrial
        22 => ['tipo' => 36, 'subtipo' => 119] , //Shopping
        23 => ['tipo' => 35, 'subtipo' => null] , //Usinas
        24 => ['tipo' => 29, 'subtipo' => null] , //PCH
        25 => ['tipo' => 31, 'subtipo' => null] , //Mineradoras
        26 => ['tipo' => 28, 'subtipo' => null] , //Jazidas
        27 => ['tipo' => 36, 'subtipo' => 121] , //SPA
        28 => ['tipo' => 36, 'subtipo' => 104] , //Pesqueiro
        29 => ['tipo' => 36, 'subtipo' => 127] , //Galpão Logístico
        30 => ['tipo' => 36, 'subtipo' => 96] , //Motel
        31 => ['tipo' => 34, 'subtipo' => null] , //UHE
        32 => ['tipo' => 32, 'subtipo' => null] , //Pedreira
        33 => ['tipo' => 36, 'subtipo' => 128] , //Empresa
        34 => ['tipo' => 36, 'subtipo' => 129] , //Minério
        35 => ['tipo' => 36, 'subtipo' => 130] , //Pedras Preciosas
        36 => ['tipo' => 36, 'subtipo' => 131] , //Rede de Televisão
        37 => ['tipo' => 36, 'subtipo' => 69] , //Hospital
        38 => ['tipo' => 26, 'subtipo' => null] , //Laje Corporativa
        39 => ['tipo' => 18, 'subtipo' => null] , //Armazém
        40 => ['tipo' => 36, 'subtipo' => 132] , //Escritório
        41 => ['tipo' => 36, 'subtipo' => 125] , //Vaga de Garagem
        42 => ['tipo' => 36, 'subtipo' => 107] , //Posto de Gasolina
        43 => ['tipo' => 9, 'subtipo' => null] , //Sobrado Comercial
        44 => ['tipo' => 36, 'subtipo' => 133] , //Condomínio Comercial
        45 => ['tipo' => 36, 'subtipo' => 134] , //Condomínio Industrial
        46 => ['tipo' => 18, 'subtipo' => null] , //Barracão Industrial
        47 => ['tipo' => 20, 'subtipo' => null] , //Conjunto Industrial
        48 => ['tipo' => 30, 'subtipo' => null] , //Prédio Industrial
        49 => ['tipo' => 36, 'subtipo' => 20] , //Academia de Ginástica
        50 => ['tipo' => 36, 'subtipo' => 21] , //Açougue
        51 => ['tipo' => 36, 'subtipo' => 23] , //Agência de Emprego
        52 => ['tipo' => 36, 'subtipo' => 24] , //Agência de Turismo
        53 => ['tipo' => 36, 'subtipo' => 26] , //Auto Elétrico
        54 => ['tipo' => 36, 'subtipo' => 28] , //Avicultura
        55 => ['tipo' => 36, 'subtipo' => 29] , //Banca de Jornal
        56 => ['tipo' => 36, 'subtipo' => 31] , //Bomboniere Atacado
        57 => ['tipo' => 36, 'subtipo' => 31] , //Bomboniere Varejo
        58 => ['tipo' => 36, 'subtipo' => 34] , //Buffet
        59 => ['tipo' => 36, 'subtipo' => 35] , //Cafeteria
        60 => ['tipo' => 36, 'subtipo' => 36] , //Cantina
        61 => ['tipo' => 36, 'subtipo' => 37] , //Casa de Sucos
        62 => ['tipo' => 36, 'subtipo' => 39] , //Centro Automotivo
        63 => ['tipo' => 36, 'subtipo' => 40] , //Chaveiro
        64 => ['tipo' => 36, 'subtipo' => 42] , //Choperia
        65 => ['tipo' => 36, 'subtipo' => 43] , //Churrascaria
        66 => ['tipo' => 36, 'subtipo' => 44] , //Clinica de Estética
        67 => ['tipo' => 36, 'subtipo' => 46] , //Copiadora
        68 => ['tipo' => 36, 'subtipo' => 48] , //Disk Pizza
        69 => ['tipo' => 36, 'subtipo' => 49] , //Distribuidora de Água
        70 => ['tipo' => 36, 'subtipo' => 50] , //Distribuidora de Bebidas
        71 => ['tipo' => 36, 'subtipo' => 51] , //Doceria
        72 => ['tipo' => 36, 'subtipo' => 52] , //Drograria
        73 => ['tipo' => 36, 'subtipo' => 54] , //Escola de Dança
        74 => ['tipo' => 36, 'subtipo' => 55] , //Escola de Idiomas
        75 => ['tipo' => 36, 'subtipo' => 56] , //Escola de Informática
        76 => ['tipo' => 36, 'subtipo' => 57] , //Escola de Música
        77 => ['tipo' => 36, 'subtipo' => 58] , //Estacionamento
        78 => ['tipo' => 36, 'subtipo' => 65] , //Fábrica
        79 => ['tipo' => 36, 'subtipo' => 67] , //Gráfica
        80 => ['tipo' => 36, 'subtipo' => 90] , //Jardinagem
        81 => ['tipo' => 36, 'subtipo' => 73] , //Laticínios
        82 => ['tipo' => 36, 'subtipo' => 74] , //Lava Rápido
        83 => ['tipo' => 36, 'subtipo' => 75] , //Lavanderia
        84 => ['tipo' => 36, 'subtipo' => 87] , //Loja de Shopping
        85 => ['tipo' => 36, 'subtipo' => 91] , //Lotérica
        86 => ['tipo' => 36, 'subtipo' => 93] , //Material de Construção
        87 => ['tipo' => 36, 'subtipo' => 94] , //Mercado
        88 => ['tipo' => 36, 'subtipo' => 98] , //Oficina Mecânica
        89 => ['tipo' => 36, 'subtipo' => 99] , //Ótica
        90 => ['tipo' => 36, 'subtipo' => 101] , //Papelaria
        91 => ['tipo' => 36, 'subtipo' => 105] , //Petshop
        92 => ['tipo' => 36, 'subtipo' => 106] , //Pizzaria
        93 => ['tipo' => 36, 'subtipo' => 135] , //Ponto Comercial
        94 => ['tipo' => 36, 'subtipo' => 114] , //Revistaria
        95 => ['tipo' => 36, 'subtipo' => 115] , //Rotisseria
        96 => ['tipo' => 36, 'subtipo' => 117] , //Salão de Cabelereiro
        97 => ['tipo' => 36, 'subtipo' => 120] , //Sorveteria
        98 => ['tipo' => 36, 'subtipo' => 124] , //Transportadora
        99 => ['tipo' => 36, 'subtipo' => 66] , //Flat Comercial
        100 => ['tipo' => 36, 'subtipo' => 63] , //Franquia
        101 => ['tipo' => 36, 'subtipo' => 136] , //Outros
        102 => ['tipo' => 36, 'subtipo' => 103] , //Perfumaria
        103 => ['tipo' => 36, 'subtipo' => 22] , //Adega
        104 => ['tipo' => 36, 'subtipo' => 25] , //Artigos Religiosos
        105 => ['tipo' => 36, 'subtipo' => 27] , //Auto Peças
        106 => ['tipo' => 36, 'subtipo' => 30] , //Bar Noturno
        107 => ['tipo' => 36, 'subtipo' => 32] , //Borracharia Rodas e Pneus
        108 => ['tipo' => 36, 'subtipo' => 33] , //Brechó
        109 => ['tipo' => 36, 'subtipo' => 38] , //Casa do Norte
        110 => ['tipo' => 36, 'subtipo' => 41] , //Chocolateria
        111 => ['tipo' => 36, 'subtipo' => 47] , //Deposito de Gás
        112 => ['tipo' => 36, 'subtipo' => 59] , //Estacionamento e Lava Rápido
        113 => ['tipo' => 36, 'subtipo' => 60] , //Fábrica de Doces e Salgados
        114 => ['tipo' => 36, 'subtipo' => 109] , //Produtos de Limpeza
        115 => ['tipo' => 36, 'subtipo' => 61] , //Farmácia de Manipulação
        116 => ['tipo' => 36, 'subtipo' => 64] , //Funilaria e Pintura
        117 => ['tipo' => 36, 'subtipo' => 68] , //Hamburgueria
        118 => ['tipo' => 36, 'subtipo' => 71] , //Lan House
        119 => ['tipo' => 36, 'subtipo' => 76] , //Loja de Artesanato
        120 => ['tipo' => 36, 'subtipo' => 77] , //Loja de Bijuteria
        121 => ['tipo' => 36, 'subtipo' => 78] , //Loja de Calçados
        122 => ['tipo' => 36, 'subtipo' => 79] , //Loja de Cama Mesa e Banho
        123 => ['tipo' => 36, 'subtipo' => 80] , //Loja de Celular
        124 => ['tipo' => 36, 'subtipo' => 81] , //Loja de Embalagens
        125 => ['tipo' => 36, 'subtipo' => 82] , //Loja de Informática
        126 => ['tipo' => 36, 'subtipo' => 83] , //Loja de Lanternas e Retrovisores
        127 => ['tipo' => 36, 'subtipo' => 84] , //Loja de Lingerie
        128 => ['tipo' => 36, 'subtipo' => 85] , //Loja de Roupas
        129 => ['tipo' => 36, 'subtipo' => 86] , //Loja de Roupas Infantis
        130 => ['tipo' => 36, 'subtipo' => 88] , //Loja de Som e Acessórios
        131 => ['tipo' => 36, 'subtipo' => 89] , //Loja de Variedades
        132 => ['tipo' => 36, 'subtipo' => 92] , //Madeireira
        133 => ['tipo' => 36, 'subtipo' => 97] , //Oficina de Costura
        134 => ['tipo' => 36, 'subtipo' => 102] , //Pastelaria
        135 => ['tipo' => 36, 'subtipo' => 110] , //Quadra de Futebol Society
        136 => ['tipo' => 36, 'subtipo' => 111] , //Quitanda
        137 => ['tipo' => 36, 'subtipo' => 116] , //Sacolão
        138 => ['tipo' => 36, 'subtipo' => 118] , //Serralheria
        139 => ['tipo' => 36, 'subtipo' => 122] , //Studio de Tatuagem
        140 => ['tipo' => 36, 'subtipo' => 126] , //Vidraçaria
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
                    'type' => 'position',
                    'field' => 'definition_02',
                    'values' => [
                        1 => "mezanino",
                        2 => "garagem", // não existe apenas "garagem"
                        3 => "estacionamento-rotativo", // não existe apenas estacionamento
                        4 => "deposito",
                        5 => "copa",
                        6 => "cozinha",
                        7 => "ar-central",
                        8 => "toldo",
                        9 => "exaustores",
                        10 => "vitrine",
                        11 => "divisoria", // não tem
                        12 => "acesso-para-deficientes",
                        13 => "atelier",
                        14 => "hall-de-entrada", // so o de entrada
                        15 => "office",
                        16 => "sala-de-reuniao",
                        17 => "auditorio",
                        18 => "cafe",
                        19 => "restaurante", // nothing like that
                        20 => "piso-elevado",
                        21 => "fibra-otica",
                        22 => "varanda",
                    ]
                ],
                [
                    'field' => 'definition_03',
                    'type' => 'position',
                    'values' => [
                        1 => "porta-de-aco", //nope
                        2 => "porta-de-vidro", //nope
                        3 => "recepcao",
                        4 => "interfone",
                        5 => "vigia",
                        6 => "extintores", // nope
                        7 => "grades",
                        8 => "sistema-de-alarme",
                    ]
                ]
            ],
            'room' => [
                [
                    'field' => 'definition_master',
                    'type' => 'patterns',
                    'values' => [
                        "piso-de-madeira",
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
                        "gabinete",
                        "janelas-de-madeira",
                        "janelas-de-aluminio",
                        "luminaria",
                        "armario-embutido",
                        "moveis-planejados",
                        "ar-condicionado",
                        "ventilador-de-teto",
                    ],
                    'options' => [
                        'internal',
                        'kitchen',
                        'bathroom',
                    ]
                ],
                [
                    'field' => 'definition_master',
                    'type' => 'position',
                    'values' => [
                        205 => "carpete-de-madeira",
                        "piso-laminado",
                        "piso-porcelanato",
                        "gesso-sanca",
                        "lavabo", //nope
                        "despensa",
                        "escritorio", //nope
                        "porta-balcao",
                        "cortina-de-vidro",
                        "armarios-individuais",
                        "churrasqueira-na-sacada", // nope
                        "medidores-de-agua-individuais",
                        "lareira",
                        "janelas-de-ferro",
                        "contra-piso",
                        "pintura-latex",
                        "servicos-pay-per-use", // nope
                        "deposito-na-garagem", // nope
                        "sistema-de-refrigeracao-central-tipo-sprit", // nope
                        "sistema-de-aquecimento-de-agua-a-gas", // nope
                        "perfil-de-estudantes", // nope
                        "piso-paviflex",
                        "laje", // nope
                        "madeira", // nope
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