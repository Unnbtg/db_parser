<?php

/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 28/03/17
 * Time: 17:40
 */
class Commercial
{

    private $types = [

        0 => ['tipo' => 25, 'subtipo' => null], //Loja
        1 => ['tipo' => 23, 'subtipo' => null], //Sala Comercial
        2 => ['tipo' => 22, 'subtipo' => null], //Galpão Comercial
        3 => ['tipo' => 36, 'subtipo' => 45] , //Consultório
        4 => ['tipo' => 21, 'subtipo' => null] , //Galeria
        5 => ['tipo' => sacola, 'subtipo' => null] , //Sobreloja
        6 => ['tipo' => sacola, 'subtipo' => null] , //Escola
        7 => ['tipo' => sacola, 'subtipo' => null] , //Lanchonete
        8 => ['tipo' => sacola, 'subtipo' => null] , //Restaurante
        9 => ['tipo' => sacola, 'subtipo' => null] , //Quiosque
        10 => ['tipo' => sacola, 'subtipo' => null] , //Supermercado
        11 => ['tipo' => sacola, 'subtipo' => null] , //Mini-Mercado
        12 => ['tipo' => sacola, 'subtipo' => null] , //Padaria
        13 => ['tipo' => sacola, 'subtipo' => null] , //Salão Comercial
        14 => ['tipo' => sacola, 'subtipo' => null] , //Barracão Comercial
        15 => ['tipo' => sacola, 'subtipo' => null] , //Conjunto Comercial
        16 => ['tipo' => sacola, 'subtipo' => null] , //Pousada
        17 => ['tipo' => sacola, 'subtipo' => null] , //Hotel
        18 => ['tipo' => sacola, 'subtipo' => null] , //Casa Comercial
        19 => ['tipo' => sacola, 'subtipo' => null] , //Indústria
        20 => ['tipo' => sacola, 'subtipo' => null] , //Prédio Comercial
        21 => ['tipo' => sacola, 'subtipo' => null] , //Galpão Industrial
        22 => ['tipo' => sacola, 'subtipo' => null] , //Shopping
        23 => ['tipo' => sacola, 'subtipo' => null] , //Usinas
        24 => ['tipo' => sacola, 'subtipo' => null] , //PCH
        25 => ['tipo' => sacola, 'subtipo' => null] , //Mineradoras
        26 => ['tipo' => sacola, 'subtipo' => null] , //Jazidas
        27 => ['tipo' => sacola, 'subtipo' => null] , //SPA
        28 => ['tipo' => sacola, 'subtipo' => null] , //Pesqueiro
        29 => ['tipo' => sacola, 'subtipo' => null] , //Galpão Logístico
        30 => ['tipo' => sacola, 'subtipo' => null] , //Motel
        31 => ['tipo' => sacola, 'subtipo' => null] , //UHE
        32 => ['tipo' => sacola, 'subtipo' => null] , //Pedreira
        33 => ['tipo' => sacola, 'subtipo' => null] , //Empresa
        34 => ['tipo' => sacola, 'subtipo' => null] , //Minério
        35 => ['tipo' => sacola, 'subtipo' => null] , //Pedras Preciosas
        36 => ['tipo' => sacola, 'subtipo' => null] , //Rede de Televisão
        37 => ['tipo' => sacola, 'subtipo' => null] , //Hospital
        38 => ['tipo' => sacola, 'subtipo' => null] , //Laje Corporativa
        39 => ['tipo' => sacola, 'subtipo' => null] , //Armazém
        40 => ['tipo' => sacola, 'subtipo' => null] , //Escritório
        41 => ['tipo' => sacola, 'subtipo' => null] , //Vaga de Garagem
        42 => ['tipo' => sacola, 'subtipo' => null] , //Posto de Gasolina
        43 => ['tipo' => sacola, 'subtipo' => null] , //Sobrado Comercial
        44 => ['tipo' => sacola, 'subtipo' => null] , //Condomínio Comercial
        45 => ['tipo' => sacola, 'subtipo' => null] , //Condomínio Industrial
        46 => ['tipo' => sacola, 'subtipo' => null] , //Barracão Industrial
        47 => ['tipo' => sacola, 'subtipo' => null] , //Conjunto Industrial
        48 => ['tipo' => sacola, 'subtipo' => null] , //Prédio Industrial
        49 => ['tipo' => sacola, 'subtipo' => null] , //Academia de Ginástica
        50 => ['tipo' => sacola, 'subtipo' => null] , //Açougue
        51 => ['tipo' => sacola, 'subtipo' => null] , //Agência de Emprego
        52 => ['tipo' => sacola, 'subtipo' => null] , //Agência de Turismo
        53 => ['tipo' => sacola, 'subtipo' => null] , //Auto Elétrico
        54 => ['tipo' => sacola, 'subtipo' => null] , //Avicultura
        55 => ['tipo' => sacola, 'subtipo' => null] , //Banca de Jornal
        56 => ['tipo' => sacola, 'subtipo' => null] , //Bomboniere Atacado
        57 => ['tipo' => sacola, 'subtipo' => null] , //Bomboniere Varejo
        58 => ['tipo' => sacola, 'subtipo' => null] , //Buffet
        59 => ['tipo' => sacola, 'subtipo' => null] , //Cafeteria
        60 => ['tipo' => sacola, 'subtipo' => null] , //Cantina
        61 => ['tipo' => sacola, 'subtipo' => null] , //Casa de Sucos
        62 => ['tipo' => sacola, 'subtipo' => null] , //Centro Automotivo
        63 => ['tipo' => sacola, 'subtipo' => null] , //Chaveiro
        64 => ['tipo' => sacola, 'subtipo' => null] , //Choperia
        65 => ['tipo' => sacola, 'subtipo' => null] , //Churrascaria
        66 => ['tipo' => sacola, 'subtipo' => null] , //Clinica de Estética
        67 => ['tipo' => sacola, 'subtipo' => null] , //Copiadora
        68 => ['tipo' => sacola, 'subtipo' => null] , //Disk Pizza
        69 => ['tipo' => sacola, 'subtipo' => null] , //Distribuidora de Água
        70 => ['tipo' => sacola, 'subtipo' => null] , //Distribuidora de Bebidas
        71 => ['tipo' => sacola, 'subtipo' => null] , //Doceria
        72 => ['tipo' => sacola, 'subtipo' => null] , //Drograria
        73 => ['tipo' => sacola, 'subtipo' => null] , //Escola de Dança
        74 => ['tipo' => sacola, 'subtipo' => null] , //Escola de Idiomas
        75 => ['tipo' => sacola, 'subtipo' => null] , //Escola de Informática
        76 => ['tipo' => sacola, 'subtipo' => null] , //Escola de Música
        77 => ['tipo' => sacola, 'subtipo' => null] , //Estacionamento
        78 => ['tipo' => sacola, 'subtipo' => null] , //Fábrica
        79 => ['tipo' => sacola, 'subtipo' => null] , //Gráfica
        80 => ['tipo' => sacola, 'subtipo' => null] , //Jardinagem
        81 => ['tipo' => sacola, 'subtipo' => null] , //Laticínios
        82 => ['tipo' => sacola, 'subtipo' => null] , //Lava Rápido
        83 => ['tipo' => sacola, 'subtipo' => null] , //Lavanderia
        84 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Shopping
        85 => ['tipo' => sacola, 'subtipo' => null] , //Lotérica
        86 => ['tipo' => sacola, 'subtipo' => null] , //Material de Construção
        87 => ['tipo' => sacola, 'subtipo' => null] , //Mercado
        88 => ['tipo' => sacola, 'subtipo' => null] , //Oficina Mecânica
        89 => ['tipo' => sacola, 'subtipo' => null] , //Ótica
        90 => ['tipo' => sacola, 'subtipo' => null] , //Papelaria
        91 => ['tipo' => sacola, 'subtipo' => null] , //Petshop
        92 => ['tipo' => sacola, 'subtipo' => null] , //Pizzaria
        93 => ['tipo' => sacola, 'subtipo' => null] , //Ponto Comercial
        94 => ['tipo' => sacola, 'subtipo' => null] , //Revistaria
        95 => ['tipo' => sacola, 'subtipo' => null] , //Rotisseria
        96 => ['tipo' => sacola, 'subtipo' => null] , //Salão de Cabelereiro
        97 => ['tipo' => sacola, 'subtipo' => null] , //Sorveteria
        98 => ['tipo' => sacola, 'subtipo' => null] , //Transportadora
        99 => ['tipo' => sacola, 'subtipo' => null] , //Flat Comercial
        100 => ['tipo' => sacola, 'subtipo' => null] , //Franquia
        101 => ['tipo' => sacola, 'subtipo' => null] , //Outros
        102 => ['tipo' => sacola, 'subtipo' => null] , //Perfumaria
        103 => ['tipo' => sacola, 'subtipo' => null] , //Adega
        104 => ['tipo' => sacola, 'subtipo' => null] , //Artigos Religiosos
        105 => ['tipo' => sacola, 'subtipo' => null] , //Auto Peças
        106 => ['tipo' => sacola, 'subtipo' => null] , //Bar Noturno
        107 => ['tipo' => sacola, 'subtipo' => null] , //Borracharia Rodas e Pneus
        108 => ['tipo' => sacola, 'subtipo' => null] , //Brechó
        109 => ['tipo' => sacola, 'subtipo' => null] , //Casa do Norte
        110 => ['tipo' => sacola, 'subtipo' => null] , //Chocolateria
        111 => ['tipo' => sacola, 'subtipo' => null] , //Deposito de Gás
        112 => ['tipo' => sacola, 'subtipo' => null] , //Estacionamento e Lava Rápido
        113 => ['tipo' => sacola, 'subtipo' => null] , //Fábrica de Doces e Salgados
        114 => ['tipo' => sacola, 'subtipo' => null] , //Produtos de Limpeza
        115 => ['tipo' => sacola, 'subtipo' => null] , //Farmácia de Manipulação
        116 => ['tipo' => sacola, 'subtipo' => null] , //Funilaria e Pintura
        117 => ['tipo' => sacola, 'subtipo' => null] , //Hamburgueria
        118 => ['tipo' => sacola, 'subtipo' => null] , //Lan House
        119 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Artesanato
        120 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Bijuteria
        121 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Calçados
        122 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Cama Mesa e Banho
        123 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Celular
        124 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Embalagens
        125 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Informática
        126 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Lanternas e Retrovisores
        127 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Lingerie
        128 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Roupas
        129 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Roupas Infantis
        130 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Som e Acessórios
        131 => ['tipo' => sacola, 'subtipo' => null] , //Loja de Variedades
        132 => ['tipo' => sacola, 'subtipo' => null] , //Madeireira
        133 => ['tipo' => sacola, 'subtipo' => null] , //Oficina de Costura
        134 => ['tipo' => sacola, 'subtipo' => null] , //Pastelaria
        135 => ['tipo' => sacola, 'subtipo' => null] , //Quadra de Futebol Society
        136 => ['tipo' => sacola, 'subtipo' => null] , //Quitanda
        137 => ['tipo' => sacola, 'subtipo' => null] , //Sacolão
        138 => ['tipo' => sacola, 'subtipo' => null] , //Serralheria
        139 => ['tipo' => sacola, 'subtipo' => null] , //Studio de Tatuagem
        140 => ['tipo' => sacola, 'subtipo' => null] , //Vidraçaria

    ];

}