<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 20/12/16
 * Time: 11:33
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\Parser\IValue\Definitions\Type;
use Microsistec\DbParser\Property;
use Microsistec\DbParser\ZipCodeService;

class PropertyParser extends AbstractParser
{
    private $finalities = [
        ["id" => 1, "name" => "Residencial"],
        ["id" => 2, "name" => "Comercial"],
        ["id" => 3, "name" => "Industrial"],
        ["id" => 4, "name" => "Rural"],
    ];

    private $rooms = [
        ['id' => 1, 'name' => 'dorm'],
        ['id' => 2, 'name' => 'suit'],
        ['id' => 3, 'name' => 'bathroom'],
        ['id' => 4, 'name' => 'room'],
        ['id' => 5, 'name' => 'kitchen'],
        ['id' => 6, 'name' => 'parking_lot'],
        ['id' => 7, 'name' => 'housekeeper_room'],
        ['id' => 8, 'name' => 'lavatory'],
        ['id' => 9, 'name' => 'car_garage']
    ];

    private $types = [
        ["id" => 1, "name" => "Apartamento", "prefix" => "AP", "finality" => [1]],
        ["id" => 2, "name" => "Cobertura", "prefix" => "CO", "finality" => [1]],
        ["id" => 3, "name" => "Flat", "prefix" => "FL", "finality" => [1]],
        ["id" => 4, "name" => "Kitchinete", "prefix" => "KI", "finality" => [1]],
        ["id" => 5, "name" => "Penthouse", "prefix" => "PE", "finality" => [1]],
        ["id" => 6, "name" => "Loft", "prefix" => "LF", "finality" => [1]],
        ["id" => 7, "name" => "Studio", "prefix" => "ST", "finality" => [1]],
        ["id" => 8, "name" => "Casa", "prefix" => "CA", "finality" => [1, 2]],
        ["id" => 9, "name" => "Sobrado", "prefix" => "SB", "finality" => [1, 2]],
        ["id" => 10, "name" => "Loteamento", "prefix" => "LO", "finality" => [1, 2, 3, 4]],
        ["id" => 11, "name" => "Terreno", "prefix" => "TE", "finality" => [1, 2, 3, 4]],
        ["id" => 12, "name" => "Chácara", "prefix" => "CH", "finality" => [4]],
        ["id" => 13, "name" => "Sítio", "prefix" => "SI", "finality" => [4]],
        ["id" => 14, "name" => "Fazenda", "prefix" => "FA", "finality" => [4]],
        ["id" => 15, "name" => "Haras", "prefix" => "HA", "finality" => [4]],
        ["id" => 16, "name" => "Rancho", "prefix" => "RA", "finality" => [4]],
        ["id" => 17, "name" => "Área", "prefix" => "AR", "finality" => [2, 3]],
        ["id" => 18, "name" => "Armazém/Barracão", "prefix" => "AZ", "finality" => [2, 3]],
        ["id" => 19, "name" => "Conjunto Comercial", "prefix" => "CC", "finality" => [2]],
        ["id" => 20, "name" => "Conjunto Industrial", "prefix" => "CI", "finality" => [3]],
        ["id" => 21, "name" => "Galeria", "prefix" => "GL", "finality" => [2]],
        ["id" => 22, "name" => "Galpão", "prefix" => "GP", "finality" => [2, 3]],
        ["id" => 23, "name" => "Sala", "prefix" => "SA", "finality" => [2]],
        ["id" => 24, "name" => "Salão", "prefix" => "SLO", "finality" => [2]],
        ["id" => 25, "name" => "Loja", "prefix" => "LJ", "finality" => [2]],
        ["id" => 26, "name" => "Laje Corporativa", "prefix" => "LA", "finality" => [2]],
        ["id" => 27, "name" => "Indústria", "prefix" => "IN", "finality" => [3]],
        ["id" => 28, "name" => "Jazidas", "prefix" => "JA", "finality" => [3]],
        ["id" => 29, "name" => "PCH", "prefix" => "PCH", "finality" => [3]],
        ["id" => 30, "name" => "Prédio", "prefix" => "PR", "finality" => [2, 3]],
        ["id" => 31, "name" => "Mineradora", "prefix" => "MI", "finality" => [3]],
        ["id" => 32, "name" => "Pedreira", "prefix" => "PD", "finality" => [3]],
        ["id" => 33, "name" => "Sobreloja", "prefix" => "SL", "finality" => [2]],
        ["id" => 34, "name" => "UHE", "prefix" => "UHE", "finality" => [3]],
        ["id" => 35, "name" => "Usina", "prefix" => "US", "finality" => [3]],
        ["id" => 36, "name" => "Fundo de comércio", "prefix" => "FU", "finality" => [2]],
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $property = new Property();

        $property->zipcode = $this->maskCep($model['cep']);
        $property->maintence_id = $model['id imovel'];

        $adressService = new ZipCodeService();
        $result = $adressService->getAddress($property->zipcode);

        if (!$result) {
            throw new ParserException("Imóvel de Id {$property->maintence_id} Endereço não foi localizado, e portanto excluido da publicação.", ParserException::CODE_EXCLUDED);
        }

        $property->created_at = $this->formatDate($model['data cadastro']);
        $property->updated_at = $this->formatDate($model['data atualizacao']);
        $property->reference = $model['referencia'];
        $property->acceptFinancing = $this->simNaoToBool($model['aceita financiamento']);
        $property->type = $this->getFromComplexConfig($model['tipo'], $this->types);
        $property->finality = $this->getFromComplexConfig($model['finalidade'], $this->finalities);

        $property->sell_price = $model['valor venda'];

        if ($property->sell_price) {
            $property->for_sale = true;
        }

        $property->rent_price = $model['valor locacao'];

        if ($property->rent_price) {
            $property->for_rent = true;
        }

        $property->street_number = $model['numero'];
        $property->street = $model['tipo logradouro'] . " " . $model['logradouro'];
        $property->complementary = $model['complemento'];
        $property->condominium_price = $model['valor condominio'];
        $property->notes = $model['descricao geral'];
        $property->total_area = $model['area total'];
        $property->total_built_area = $model['area util construida'];
        $property->website_home_highlight = $this->simNaoToBool($model['destaque']);
        $property->website_title = $model['titulo'];
        $property->website_notes = $model['descricao site'];
        $property = $this->parseArea($property, $model['dimensao terreno']);
        $property->acceptFgts = $this->simNaoToBool($model['fgts']);
        $property->acceptFgts = $this->simNaoToBool($model['fgts']);
        $property->floor = $model['andar'];

        $property->has_board = $this->booleanValue($model['placa']);
        $property->fgts = $this->booleanValue($model['fgts']);

        $property->age = date('Y') - $model['ano construcao'];
        $property->characteristics = $this->processCharacteristics($model);
        $property->iptu_price = $model['valor iptu'];
        $property->neighborhood_id = $result['id_bairro'];
        $property->neighborhood = $result['bairro']['nome'];
        $property->city_id = $result['id_cidade'];
        $property->city = $this->createCity($result['id_cidade'], $this->getState($result['id_uf']), $result['cidade']['nome']);
        $property->neighborhood = $this->createNeighborhood($result['id_bairro'], $result['id_cidade'], $result['bairro']['nome']);
        $property->state_id = $this->getState($result['id_uf']);

        $property->room = $this->addRoom("room", $model['salas']);
        $property->bedroom = $this->addRoom("dorm", $model['dormitorios']);
        $property->suites = $this->addRoom('suit', $model['suites']);
        $property->parking_lot = $this->addRoom('parking_lot', $model['garagens cobertas'] + $model['garagens descobertas']);
        $property->kitchen = $this->addRoom('kitchen', (int)$this->booleanValue($model['cozinha']));
        $property->bathroom = $this->addRoom('bathroom', $model['banheiros']);
        $property->lavatory = $this->addRoom('lavatory', (int)$this->booleanValue($model['lavabo']));

        $property->user_id = $model['usuario cadastro'];

        return $property;
    }


    protected function addRoom($room, $qtd)
    {
        $toAdd = [
            'name' => "",
            'type' => $this->getFromComplexConfig($room, $this->rooms)
        ];

        return array_fill(0, $qtd, $toAdd);
    }

    protected function processCharacteristics($model)
    {
        $characteristics = [];

        $fromTo = [
            'service_area' => "area serviço",
            'lavanderia' => 'lavanderia',
            'Despensa' => 'Despensa',
            'Churrasqueira' => 'Churrasqueira',
            'Quadra Poliesportiva' => 'Quadra Poliesportiva',
            'Campo de Futebol' => 'Campo de Futebol',
            'Varanda' => 'Varanda',
            'Sacada' => 'Sacada',
            'Quintal' => 'Quintal',
            'Terraço' => 'Terraço',
            'Mobiliado' => 'Mobiliado',
            'Vista para o mar' => 'Vista Mar',
            'Solarium' => 'Solarium',
            'Copa' => 'Copa',
            'alarm_monitored' => "alarme",
            'wc_maid' => 'banheiro empregada',
            'cable_tv' => 'tv cabo',
            'bancle' => 'guarita',
            'hidro' => 'hidro',
            'equinocultura' => 'equinocultura',
            'piscultura' => 'piscultura',
            'pool' => 'piscina',
            'granja' => 'granja',
            'generator' => 'gerador',
            'curral' => 'currais',
            'estabulo' => 'estabulo',
            'cold_floor' => 'psio frio',
            'bladed_floor' => 'piso laminado',
            'wood_carpet' => 'carpete madeira',
            'carpete' => 'carpete',
            'pomar' => 'pomar',
            'Poço Artesiano' => 'artesiano',
            'lake' => 'lago',
            'varanda_gourmet' => 'varanda gourmet',
            'contra_piso' => 'contra piso',
            'piso granito' => 'piso granito',
            'piso marmore' => 'piso marmore',
            'piso porcelanato' => 'piso porcelanato',
        ];
    }

    protected function parseArea($property, $area)
    {
        $area = explode('x', $area);
        if (is_array($area)) {
            return $property;
        }
        $property->area_width = $area[0];
        $property->area_height = $area[1];

        return $property;
    }
}