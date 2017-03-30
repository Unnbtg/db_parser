<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 29/03/2017
 * Time: 17:13
 */

namespace Microsistec\DbParser\Parser\Desktop\Dictionaries;


use Microsistec\DbParser\Definition\PropertyType\Terrain;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Apartment;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Commercial;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\House;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Rural;

class CharacteristicsDictionary
{
    const SciOnline = [
        'property' => [
            'type' => 1,
            'options' => [
                1 => "2-entradas",
                2 => "alarme-monitorado",
                3 => "area-de-servico",
                4 => "atelier",
                5 => "bangalo",
                6 => "bicicletario",
                7 => "brinquedoteca",
                8 => "cachoeira",
                9 => "campo-de-futebol",
                10 => "central-de-gas",
                11 => "cftv",
                12 => "churrasqueira",
                13 => "cinema",
                14 => "deck-molhado",
                15 => "deck-para-barco",
                16 => "deposito-na-garagem",
                17 => "elevador-cadeirante",
                18 => "elevador-seguranca",
                19 => "elevador-de-servico",
                20 => "elevador-social",
                21 => "entrada-de-servico",
                22 => "entrada-lateral",
                23 => "espaco-gourmet",
                24 => "espaco-grill",
                25 => "espaco-motos",
                26 => "espaco-mulher",
                27 => "espaco-zen",
                28 => "fogao-a-lenha",
                29 => "forno-de-pizza",
                30 => "frente-para-o-mar",
                31 => "garage-band",
                32 => "garagem-ar-livre",
                33 => "garagem-coletiva",
                34 => "garagem-coletiva-insulficiente",
                35 => "garagem-demarcada",
                36 => "garagem-escriturada",
                37 => "garagem-fechada",
                38 => "garagem-privativa",
                39 => "gerador-de-emergencia",
                40 => "guarita",
                41 => "hall-de-entrada",
                42 => "horta",
                43 => "interfone",
                44 => "lago",
                45 => "lan-house",
                46 => "lavanderia-coletiva",
                47 => "lazer-na-cobertura",
                48 => "manobrista",
                49 => "mata-nativa",
                50 => "mirante",
                51 => "nascente",
                52 => "office",
                53 => "parabolica",
                54 => "parque-aquatico",
                55 => "pecuaria",
                56 => "pergolado",
                57 => "pet-place",
                58 => "piscina",
                59 => "piscina-adulto",
                60 => "piscina-aquecida",
                61 => "piscina-da-cobertura",
                62 => "piscina-infantil",
                63 => "pista-de-bocha",
                64 => "pista-de-caminhada",
                65 => "pista-de-skate",
                66 => "playground",
                67 => "pomar",
                68 => "port-cochere",
                69 => "portao-eletronico",
                70 => "portaria",
                71 => "quadra-de-tenis",
                72 => "quadra-de-volei",
                73 => "quadra-poliesportiva",
                74 => "redario",
                75 => "sacada",
                76 => "sacada-panoramica",
                77 => "sala-de-ginastica",
                78 => "salao-de-festas",
                79 => "salao-de-jogos",
                80 => "sauna",
                81 => "servico-de-praia",
                82 => "servicos-pay-per-use",
                83 => "sistema-de-aquecimento-de-agua-a-gas",
                84 => "sistema-de-refrigeracao-central-tipo-sprit",
                85 => "solarium",
                86 => "spa",
                87 => "telefonia-pabx",
                88 => "terraco",
                89 => "tv-assinatura",
                90 => "vaga-anti-sequestro",
                91 => "varanda",
                92 => "varanda-gourmet",
                93 => "vigia",
                94 => "vista-para-o-mar",
                95 => "wi-fi",
                96 => "janelas-de-madeira",
                97 => "janelas-de-aluminio",
                98 => "janelas-de-ferro",
                99 => "grades-de-ferro",
                100 => "grades-de-aluminio",
                101 => "mina",
                102 => "poço-caipira",
                103 => "poco-semi-artesiano",
                104 => "poco-artesiano",
                105 => "rede-publica",
                106 => "gerador-proprio",
                107 => "energia-publica",
                108 => "hortalicas",
                109 => "plantacao-de-laranja",
                110 => "plantacao-de-milho",
                111 => "plantacao-de-soja",
                112 => "plantacao-de-cafe",
                113 => "plantacao-de-cana",
                114 => "granja",
                115 => "piscicultura",
                116 => "equinocultura",
                117 => "suinocultura",
                118 => "avicultura",
                119 => "pecuaria-(corte)",
                120 => "pecuaria-(leite)",
                121 => "canil",
                122 => "galinheiro",
                123 => "circuito-de-seguranca",
                124 => "janelas",
                125 => "portas",
                126 => "mobiliado",
                128 => "wc-empregada",
                129 => "armarios-individuais",
                130 => "churrasqueira-na-sacada",
                131 => "desmembramento",
                132 => "escritorio",
                133 => "esquina",
                134 => "jardim",
                135 => "laje",
                136 => "medidores-de-agua-individuais",
                137 => "meio-lote",
                138 => "ovicultura",
                139 => "perfil-de-estudantes",
                140 => "pre-fabricada",
                141 => "pre-moldada",
                142 => "ranario",
                143 => "avestruz",
                144 => "corrego",
                145 => "jacuzzi",
                146 => "lavanderia",
                147 => "quintal",
                148 => "casa-de-caseiro",
                149 => "capela",
                150 => "curral",
                151 => "paiol",
                152 => "redondel",
                153 => "estabulo",
                154 => "galpao",
                155 => "cocheira",
                156 => "piquete",
                157 => "tuia",
                158 => "terreiros-de-cafe",
                159 => "silos-de-graos",
                160 => "mangueira",
                161 => "arenoso",
                162 => "argiloso",
                163 => "terra-roxa",
                164 => "mangue",
                165 => "pedregoso",
                166 => "plano",
                167 => "declive",
                168 => "aclive",
                169 => "leve-declive",
                170 => "leve-aclive",
                171 => "zelador",
                172 => "vestiario",
                173 => "decorado",
                174 => "escritorio",
                175 => "jardim-de-inverno",
                176 => "pe-direito-duplo",
                177 => "reflorestamento",
                178 => "caprinocultura",
                179 => "estacao-de-gas",
                180 => "doca",
                181 => "cabine-primaria",
                182 => "kva-cabine-primaria",
                183 => "ponte-rolante",
                184 => "divisoria",
                185 => "recepcao",
                186 => "tulha",
                187 => "mezanino",
                188 => "litoral",
                189 => "pe-na-areia",
                190 => "110v",
                191 => "220v",
                192 => "330v",
                193 => "monofasico",
                194 => "bifasico",
                195 => "trifasico",
                196 => "cimento-queimado",
                197 => "piso-ardosia",
                198 => "turismo-rural",
                199 => "pista-de-pouso",
                200 => "heliponto",
                201 => "rio",
                202 => "dormitorio-reversivel",
                203 => "sem-condominio",
                204 => "beira-mar",
                205 => "citrus",
                206 => "fruticultura",
                207 => "casa-sede",
                208 => "casa-colono",
                209 => "açude",
                210 => "pivo-irrigacao",
                211 => "cerca",
                212 => "estrada-interna",
                213 => "baia-cavalo",
                214 => "lavrador",
                215 => "mangueiro",
                216 => "garagem-para-maquinario",
                217 => "tanque-de-peixes",
                218 => "piso-de-taco",
                219 => "carpete-de-nylon",
                220 => "acesso-para-deficientes",
                221 => "agua",
                222 => "aquecimento-eletrico",
                223 => "central-telefonica",
                224 => "elevador-privativo",
                225 => "reservatorio-de-agua",
                226 => "rua-asfaltada",
                227 => "sala-de-reuniao",
                228 => "vestiario-para-diaristas",
                229 => "auditorio",
                230 => "bosque",
                231 => "campo-de-golfe",
                232 => "ciclovia",
                233 => "clube",
                234 => "forno-a-lenha",
                235 => "lareira",
                236 => "ofuro",
                237 => "piano-bar",
                238 => "pista-de-cooper",
                239 => "quadra-de-squash",
                240 => "quadra-gramada",
                241 => "sala-fitness",
                242 => "sauna-seca",
                243 => "sauna-umida",
                244 => "catraca-eletronica",
                245 => "segurança-interna",
                246 => "segurança-patrimonial",
                247 => "sistema-de-incendio",
                248 => "vigilancia-24h",
                249 => "estacionamento-rotativo",
                250 => "praca-de-convivencia",
                251 => "vaga-para-visita",
                252 => "deposito",
                253 => "copa",
                254 => "cozinha",
                255 => "ar-central",
                256 => "toldo",
                257 => "exaustores",
                258 => "vitrine",
                259 => "piso-elevado",
                260 => "fibra-otica",
                261 => "portal-de-entrada",
                262 => "cerca-arame-liso",
                263 => "cerca-regua",
                264 => "cerca-arame-farpado",
                265 => "cerca-eletrica",
                266 => "academia",
                267 => "aquecimento",
                268 => "conexao-a-internet",
                269 => "conjunto-fechado",
                270 => "espaco-juvenil",
                271 => "espaco-verde-parque",
                272 => "espelhos-d-agua",
                273 => "gerador-eletrico",
                274 => "grama",
                275 => "home-office",
                276 => "home-cinema",
                277 => "sala-massagem",
                278 => "prendido-inteiramente",
                279 => "salao-de-jogos-adulto",
                280 => "salao-de-jogos-juvenil",
                281 => "segurança-24-horas",
                282 => "serviços-de-limpeza",
                283 => "sistema-de-alarme",
                284 => "tv-a-cabo",
                285 => "vista-exterior",
                286 => "vista-para-a-montanha",
                287 => "vista-para-lago",
                288 => "Vista para a montanha",
                289 => "Vista para lago",
            ]
        ],
        "room" => [
            'type' => 2,
            'options' => [
                1 => "piso-de-madeira",
                2 => "piso-frio",
                3 => "carpete",
                4 => "azulejo-ate-o-teto",
                5 => "azulejo-parcial",
                6 => "parede-com-textura",
                7 => "parede-com-revestimento",
                8 => "parede-em-alvenaria",
                9 => "parede-com-massa-corrida",
                10 => "gesso-moldura",
                11 => "gesso-rebaixado",
                12 => "ambiente-em-l",
                13 => "2-ambientes",
                14 => "3-ambientes",
                15 => "cozinha-americana",
                16 => "copa",
                17 => "box-simples",
                18 => "box-blindex",
                19 => "pia-com-cuba-externa",
                20 => "pia-de-marmore",
                21 => "pia-de-aluminio",
                22 => "gabinete",
                23 => "closet",
                24 => "hidromassagem",
                25 => "janelas-de-madeira",
                26 => "janelas-de-aluminio",
                27 => "janelas-de-ferro",
                28 => "luminaria",
                29 => "armario-embutido",
                30 => "moveis-planejados",
                31 => "ar-condicionado",
                32 => "ventilador-de-teto",
                33 => "lareira",
                34 => "grades-de-ferro",
                35 => "grades-de-aluminio",
                36 => "papel-de-parede",
                37 => "janelas",
                38 => "portas",
                39 => "ladrilho",
                40 => "pedra",
                41 => "granito",
                42 => "tijolinho",
                43 => "litoceramica",
                44 => "pintura-texturizada",
                45 => "carpete-de-madeira",
                46 => "piso-laminado",
                47 => "piso-porcelanato",
                48 => "gesso-sanca",
                49 => "despensa",
                50 => "porta-balcao",
                51 => "cortina-de-vidro",
                52 => "contra-piso",
                53 => "pintura-latex",
                54 => "piso-paviflex",
                55 => "piso-ceramica",
                56 => "piso-marmore",
                57 => "piso-granito",
                58 => "armario",
                59 => "cimento-queimado",
                60 => "piso-emborrachado",
                61 => "piso-ardosia",
                62 => "piso-aquecido",
                63 => "piso-de-taco",
                64 => "carpete-de-nylon"
            ]
        ],
        'proximity' => [
            'type' => 3,
            'options' => [
                1 => "academia",
                2 => "banco",
                3 => "bar-e-choperia",
                4 => "delegacia",
                5 => "escola",
                6 => "farmacia",
                7 => "feira-livre",
                8 => "hospital",
                9 => "igreja",
                10 => "industria",
                11 => "padaria",
                12 => "parque-e-praca",
                13 => "petshop",
                14 => "ponto-de-onibus",
                15 => "posto-de-combustivel",
                16 => "restaurante",
                17 => "supermercado",
                18 => "universidade",
                19 => "estacao-de-metro",
                20 => "posto-de-saude",
                21 => "clinica-de-saude",
                22 => "clinica-veterinaria",
                23 => "banca-de-jornal",
                24 => "estacao-rodoviaria",
                25 => "estacionamento",
                26 => "loterica",
                27 => "salao-de-beleza",
                28 => "cinema",
                29 => "dentista",
                30 => "ponto-de-taxi",
                31 => "barbearia",
                32 => "shopping",
                33 => "praia",
                34 => "centro"
            ]
        ],
    ];

    const SciDesktop = [
        House::class => [
            'property' => [
                [
                    'field' => 'definition_02',
                    'type' => "position",
                    "values" => [
                        1 => "varanda",
                        2 => "lavanderia",
                        3 => "quintal",
                        4 => "churrasqueira",
                        5 => "piscina",
                        7 => "terraco",
                        8 => "grades",
                        9 => "muros",
                        10 => "portao-automatico", //não tem
                        11 => "area-de-servico",
                        12 => "jardim",
                        13 => "salao-de-festas",
                        14 => "sauna",
                        15 => "solarium",
                        16 => "interfone",
                        17 => "central-de-gas",
                        18 => "aquecimento-solar", // não tem
                        19 => "entrada-lateral",
                        20 => "deposito",
                        21 => "sacada",
                        22 => "sacada-panoramica",
                        23 => "forno-de-pao-e-pizza", // so tem o de pizza e de pao não
                        24 => "gerador-de-emergencia",
                        25 => "garagem-fechada",
                        26 => "piscina-aquecida",
                        27 => "deck-molhado",
                        28 => "parque-aquatico",
                        29 => "salao-de-jogos",
                        30 => "fitness", // no sci online so tem fitness
                        31 => "quadra-poliesportiva",
                        32 => "quadra-de-volei",
                        33 => "quadra-de-tenis",
                        34 => "espaco-gourmet",
                        35 => "espaco-grill",
                        36 => "playground",
                        37 => "brinquedoteca",
                        38 => "hall-social", // so hall de entrada
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
                        49 => "estar-com-pergolado", // nao tem e o que demonios é isso??
                        50 => "espaco-zen",
                        51 => "redario",
                        52 => "pista-de-skate",
                        53 => "pista-de-caminhada",
                        54 => "pista-de-bocha",
                        55 => "pet-place",
                        56 => "praca-da-arvore", //não tem
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
                        "piso-de-madeira",
                        "piso-frio",
                        "carpete",
                        "ladrilho",
                        "pedra",
                        "granito",
                        "alvenaria", // só tem parede em alvenaria
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
                        "luminarias",
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
        ],
        Apartment::class => [
            "property" => [
                [
                    'field' => 'definicao_02',
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
                        19 => "sauna-vapor",//existe sauna, sauna-umida ou sauna-seca
                        20 => "jacuzzi"
                    ]
                ],
                [
                    'field' => 'definicao_03',
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
                        10 => "deposito",
                        11 => "sacada-panoramica",
                        12 => "forno-de-poo-e-pizza", // so tem o de pizza o de pão não
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
                        27 => "estar-com-pergolado",
                        28 => "redario",
                        29 => "praça-da-arvore", // a famosa
                        30 => "pomar",
                        31 => "lago",
                        32 => "deck-para-barco",
                        33 => "sacada-tecnica", // tem naum
                    ]
                ],
                [
                    'field' => 'definicao_04',
                    'type' => 'position',
                    'values' => [
                        1 => "guarita",
                        2 => "portaria",
                        3 => "portao-eletronico",
                        4 => "circuito-fechado-tv", //tem circuito de segurança, mas não especifica que é de tv
                        5 => "interfone",
                        6 => "alarme-monitorado",
                        7 => "vigia",
                        8 => "vaga-anti-sequestro",
                    ]
                ],
                [
                    'field' => 'definicao_05',
                    'type' => 'position',
                    'values' => [
                        1 => "elevador-social",
                        2 => "elevador-de-servico",
                        3 => "hall-de-entrada",
                        4 => "entrada-de-servico",
                        5 => "central-de-gas",
                        6 => "garagem-privativa",
                        7 => "garagem-coletiva-suficiente", //tem apenas garagem-coletiva...nao indica ser suficiente
                        8 => "garagem-coberta", //não tem
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
                    'field' => 'definicao_master',
                    'type' => 'patterns',
                    'values' => [
                        "piso-de-madeira",
                        "piso-frio",
                        "carpete",
                        "ladrilho",
                        "pedra",
                        "granito",
                        "alvenaria", // só tem parede em alvenaria
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
                        "luminarias",
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
                    'field' => 'definicao_master',
                    'type' => 'position',
                    'values' => [
                        "carpete-de-madeira",
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
        ],
        Commercial::class => [
            'property' => [
                [
                    'type' => 'position',
                    'field' => 'definicao_02',
                    'values' => [
                        1 => "mezanino",
                        2 => "garagem", // não existe apenas "garagem"
                        3 => "estacionamento", // não existe apenas estacionamento
                        4 => "deposito",
                        5 => "copa",
                        6 => "cozinha",
                        7 => "ar-central",
                        8 => "toldo",
                        9 => "exaustores",
                        10 => "vitrine",
                        11 => "divisorias", // não tem
                        12 => "acesso-para-deficientes",
                        13 => "atelier",
                        14 => "hall-social", // so o de entrada
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
                    'field' => 'definicao_03',
                    'type' => 'position',
                    'values' => [
                        1 => "porta-de-aco", //nope
                        2 => "porta-de-vidro", //nope
                        3 => "recepcao",
                        4 => "interfone",
                        5 => "vigia",
                        6 => "extintores", // nope
                        7 => "grades", // nope
                        8 => "sistema-de-alarme",
                    ]
                ]
            ],
            'room' => [
                [
                    'field' => 'definicao_master',
                    'type' => 'patterns',
                    'values' => [
                        "piso-de-madeira",
                        "piso-frio",
                        "carpete",
                        "ladrilho",
                        "pedra",
                        "granito",
                        "alvenaria", // só tem parede em alvenaria
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
                        "luminarias",
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
                    'field' => 'definicao_master',
                    'type' => 'position',
                    'values' => [
                        "carpete-de-madeira",
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
        ],
        Rural::class => [
            'property' => [
                [
                    'field' => 'definicao_02',
                    'type' => 'position',
                    'values' => [
                        1 => "casa-de-caseiro",
                        2 => "salao-de-festas",
                        3 => "capela",
                        4 => "curral",
                        5 => "paiol",
                        6 => "redondel",
                        7 => "estabulo",
                        8 => "galpao",
                        9 => "cocheira",
                        10 => "piquete",
                        11 => "tuia",
                        12 => "terreiros-de-cafa",
                        13 => "silos-de-graos",
                        14 => "mangueira",
                    ]
                ],
                [
                    'field' => 'definicao_03',
                    'type' => 'position',
                    'values' => [
                        1 => "portal-de-entrada",
                        2 => "cerca-arame-liso",
                        3 => "cerca-regua",
                        4 => "cerca-arame-farpado",
                        5 => "guarita",
                        6 => "asfalto",// tem rua asfaltada... acredito que seja a mesma coisa.
                        7 => "sem-calcamento",//nope
                        8 => "pedregulho",//nope
                        9 => "paralelepipedo",//nope
                        10 => "cerca-eletrica",
                        11 => "sistema-de-seguranca"// nope
                    ]
                ],
                [
                    'field' => 'deinificao_master',
                    'type' => [
                        "playground",
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
                    ]
                ]
            ]
        ],
        Terrain::class => [
            'property' => [
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
                ]
            ],
            'proximity' => [
                [
                    'type' => 'position',
                    'field' => 'definition_master',
                    'values' => [
                        1 => "padaria",
                        2 => "supermercado",
                        3 => "ponto-de-onibus",
                        4 => "escola"
                    ]
                ]

            ]
        ]
    ];
}