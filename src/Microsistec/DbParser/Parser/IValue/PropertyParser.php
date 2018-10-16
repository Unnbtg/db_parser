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

    private $types = [
        ["id" => 1, "name" => "Apartamento", "prefix" => "AP", "finality" => [1]],
        ["id" => 1, "name" => "Apartamento Duplex", "prefix" => "AP", "finality" => [1]],  //Apartamento duplex no ivalue, vira apto no sci
        ["id" => 2, "name" => "Cobertura", "prefix" => "CO", "finality" => [1]],
        ["id" => 3, "name" => "Flat", "prefix" => "FL", "finality" => [1]],
        ["id" => 4, "name" => "Kitnet", "prefix" => "KI", "finality" => [1]], //Kitchinete no SCI
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
        ["id" => 18, "name" => "Barracão", "prefix" => "AZ", "finality" => [2, 3]], //Armazem/Barracao no SCI
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
        ["id" => 30, "name" => "Prédio", "prefix" => "PR", "finality" => [1, 2, 3]],
        ["id" => 31, "name" => "Mineradora", "prefix" => "MI", "finality" => [3]],
        ["id" => 32, "name" => "Pedreira", "prefix" => "PD", "finality" => [3]],
        ["id" => 33, "name" => "Sobreloja", "prefix" => "SL", "finality" => [2]],
        ["id" => 34, "name" => "UHE", "prefix" => "UHE", "finality" => [3]],
        ["id" => 35, "name" => "Usina", "prefix" => "US", "finality" => [3]],
        ["id" => 36, "name" => "Ponto", "prefix" => "FU", "finality" => [2]], //Fundo de comercio no SCI
        ["id" => 36, "name" => "Pousada", "prefix" => "FU", "finality" => [2]], //Fundo de comercio no SCI
    ];

    private $flag = [
        'Ativo'     => 1, //Ativo
        'Cancelado' => 2, //Bloqueado (Cancelado no gaia)
        'Vendido'   => 3, //Vendido
        'Suspenso'  => 4, //Suspenso
        'Locado'    => 5, //Alugado
        'Ficha'     => 6, //Reservado (ficha no gaia)
    ];

    private $situation = [
        ["id" => 1, "name" => "Desocupado"],
        ["id" => 1, "name" => "Em construção"],
        ["id" => 1, "name" => "Não Informado"],
        ["id" => 3, "name" => "Ocupado"],
    ];

    private $orientation = [
        ["id" => 1, "name" => "Frente"],
        ["id" => 2, "name" => "Lateral"],
        ["id" => 3, "name" => "Fundos"],
        ["id" => 4, "name" => "Norte"],
        ["id" => 5, "name" => "Norte-Leste"],
        ["id" => 6, "name" => "Norte-Oeste"],
        ["id" => 7, "name" => "Sul"],
        ["id" => 8, "name" => "Sul-Leste"],
        ["id" => 9, "name" => "Sul-Oeste"],
        ["id" => 10, "name" => "Leste"],
        ["id" => 11, "name" => "Oeste"]
    ];

    private $topography = [
        ["id" => 1, "name" => "Arenoso"],
        ["id" => 2, "name" => "Argiloso"],
        ["id" => 3, "name" => "Terra Roxa"],
        ["id" => 4, "name" => "Mangue"],
        ["id" => 5, "name" => "Pedregoso"],
        ["id" => 6, "name" => "Plano"],
        ["id" => 7, "name" => "Declive"],
        ["id" => 8, "name" => "Aclive"],
        ["id" => 9, "name" => "Leve declive"],
        ["id" => 10, "name" => "Leve aclive"],
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $property                   = new Property();
        $property->maintence_id     = $model['id imovel'];
        $property->id               = $model['id imovel'];
        $property->code             = $model['id imovel'];
        $property->alternative_code = $model['referencia'];
        $property->user_code        = $model['id imovel'];
        $property->old_type         = $model['tipo'];
        $property->finality         = $this->getFromComplexConfig($model['finalidade'], $this->finalities);
        $property->type             = $this->getFromComplexConfig($model['tipo'], $this->types);
        $property->subtype          = null;

        $property->for_rent = false;
        if ($model['valor locacao'] > 0) {
            $property->for_rent = true;
        }

        $property->for_sale = false;
        if ($model['valor venda'] > 0) {
            $property->for_sale = true;
        }

        $property->for_vacation                  = false;
        $property->situation                     = $this->getFromComplexConfig($model['ocupacao'], $this->situation) ? $this->getFromComplexConfig($model['ocupacao'], $this->situation) : null;
        $property->has_board                     = $this->booleanValue($model['placa']);
        $property->zipcode                       = $this->unMask($model['cep']);
        $property->state_id                      = null;
        $property->city_id                       = null;
        $property->neighborhood_id               = null;
        $property->zone                          = null;
        $property->street                        = trim($model['tipo logradouro'] . ' ' . $model['logradouro']);
        $property->block                         = null;
        $property->street_number                 = $model['numero'];
        $property->complementary                 = $model['complemento'];
        $property->condominium_name              = null;
        $property->age                           = $model['ano construcao'] > 0 ? (string)(date('Y') - $model['ano construcao']) : null;
        $property->floor                         = $model['andar'];
        $property->level                         = null;
        $property->sell_price                    = $model['valor venda'];
        $property->monthly_installments          = null;
        $property->monthly_installments_value    = null;
        $property->quarterly_installments        = null;
        $property->quarterly_installments_value  = null;
        $property->semiannual_installments       = null;
        $property->semiannual_installments_value = null;
        $property->annual_installments           = null;
        $property->annual_installments_value     = null;
        $property->keys_installments             = null;
        $property->keys_installments_value       = null;
        $property->rent_price                    = $model['valor locacao'];
        $property->iptu_price                    = $model['valor iptu'];
        $property->condominium_price             = $model['valor condominio'];
        $property->fgts                          = $this->booleanValue($model['fgts']);
        $property->letter_of_credit              = false;
        $property->bank_financing                = $this->simNaoToBool($model['aceita financiamento']);
        $property->direct_financing              = false;
        $property->lessor_bail                   = false;
        $property->guarantor                     = false;
        $property->deposit                       = false;
        $property->mcmv                          = false;
        $property->requires_guarantor_deed       = false;
        $property->keys                          = null;
        $property->keys_available                = false;
        $property->iptu_number                   = null;
        $property->energy_number                 = null;
        $property->water_number                  = null;
        $property->registration_number           = null;
        $property->registry                      = null;
        $property->deed_status                   = null;
        $property->receiver1_id                  = null;
        $property->receiver2_id                  = null;
        $property->indicator1                    = null;
        $property->indicator2                    = null;
        $area                                    = $this->parseArea($model);
        $property->area_width                    = floatval($area['width']);
        $property->area_height                   = floatval($area['height']);
        $property->total_area                    = $model['area total'];
        $property->total_useful_area             = $model['area util construida'];
        $property->total_built_area              = null;
        $property->built_area_price              = null;
        $property->total_area_price              = null;
        $property->relative_distance             = null;
        $property->relative_distance_to          = null;
        $property->reference_point               = $model['ponto referencia'];
        $property->orientation                   = $this->getFromComplexConfig($model['face'], $this->orientation) ? $this->getFromComplexConfig($model['face'], $this->orientation) : null;
        $property->website_home_highlight        = $this->simNaoToBool($model['destaque']);
        $property->website_rotative_banner       = $this->simNaoToBool($model['super destaque']);
        $property->website_notes                 = $model['descricao site'];
        $property->website_title                 = $model['titulo'];
        $property->website_keywords              = null;
        $property->website_description           = null;
        $property->notes                         = $model['descricao geral'];
        $property->user_id                       = $model['usuario cadastro'];
        $property->branch_id                     = null;
        $property->status                        = $this->getFlag($model);
        if ($this->simNaoToBool($model['locado'])) {
            $property->status = 5;
        }
        $property->website_showcase         = false;
        $property->incra_number             = null;
        $property->incra_price              = null;
        $property->sales_authorization      = $this->simNaoToBool($model['autorizado negociacao']);
        $property->authorization_start_date = null;
        $property->authorization_end_date   = null;
        $property->lease_price              = null;
        $property->ground_type              = $this->getFromComplexConfig($model['topografia'], $this->topography) ? $this->getFromComplexConfig($model['topografia'], $this->topography) : null;
        $property->opportunity              = false;
        $property->exchange                 = $this->simNaoToBool($model['aceita permuta']);
        $property->advance_payment          = $model['sinal'];
        $property->advance_installments     = null;
        $property->owners                   = [(int)$model['id cliente']];
        $property->contacts                 = [];
        $property->features                 = $this->processCharacteristics($model);
        $property->proximities              = [];
        $property->portals                  = [];
        $property->publish                  = $this->simNaoToBool($model['site']);
        $property->vacations                = [];
        $property->photos                   = [];
        $property->videos                   = !empty($model['youtube']) ? [$model['youtube']] : [];
        $property->roomsCount               = $this->getRoomsCount($model);
        $property->roomFeatures             = (object)[];
        $property->created_at               = $this->formatDate($model['data cadastro']);
        $property->updated_at               = $this->formatDate($model['data atualizacao']);
        $property->base_uri                 = null;
        $property->original                 = null;
        $property->migration_obs            = null;
        $property->highlight_photo          = null;
        $property->measure_unit             = 1;
        $property->selling_exclusivity      = $this->simNaoToBool($model['exclusividade']);
        $property->exclusivity_start_date   = $this->formatDate($model['data inicio exclusividade']) ?: null;
        $property->exclusivity_end_date     = $this->formatDate($model['data final exclusividade']) ?: null;
        $property->city                     = $model['cidade'];
        $property->neighborhood             = $model['bairro'];
        $property->neighborhood_commercial  = $model['bairro comercial'];
        $property->state                    = $model['estado'];
        $property->draft                    = false;

        return $property;
    }

    private function parseArea($model)
    {
        $area             = $model['dimensao terreno'];
        $result           = [];
        $result['width']  = 0;
        $result['height'] = 0;

        if ($area) {
            $tmp = preg_split('/x|X/', $area);
            if (count($tmp) > 1) {
                $result['width']  = str_replace(['.', ','], ['', '.'], $tmp[0]);
                $result['height'] = str_replace(['.', ','], ['', '.'], $tmp[1]);
            }
        }

        return $result;
    }

    public function getFlag($model)
    {
        if (!isset($this->flag[$model['status']])) {
            return 2; // bloqueado por padrão
        }

        return $this->flag[$model['status']];
    }

    protected function processCharacteristics($model)
    {
        $characteristics = [];

        $chars = [
            'lavanderia'            => 146,
            'despensa'              => null,
            'area serviço'          => 3,
            'edicula'               => 304,
            'caseiro'               => 148,
            'zelador'               => 171,
            'churrasqueira'         => 12,
            'adega'                 => 323,
            'quadra poliesportiva'  => 73,
            'sauna'                 => 80,
            'vestiario'             => 172,
            'campo futebol'         => 9,
            'varanda'               => 91,
            'sacada'                => 75,
            'hidro'                 => null,
            'decorado'              => 173,
            'tv cabo'               => 286,
            'quintal'               => 147,
            'escritorio'            => 174,
            'alarme'                => 285,
            'deposito'              => 253,
            'terraco'               => 88,
            'jardim inverno'        => 175,
            'pe direito duplo'      => 176,
            'lareira'               => 296,
            'mobiliado'             => 126,
            'reflorestamento'       => 177,
            'piscicultura'          => 115,
            'caprinocultura'        => 179,
            'equinocultura'         => 116,
            'ofuro'                 => 297,
            'estacao gas'           => 180,
            'doca'                  => 181,
            'cabine primaria'       => 182,
            'kva cabine primaria'   => 183,
            'ponte rolante'         => 184,
            'divisoria'             => 185,
            'aquecimento solar'     => 305,
            'recepcao'              => 186,
            'guarita'               => 40,
            'mezanino'              => 188,
            'litoral'               => 189,
            'vista mar'             => 94,
            'pe na areia'           => 190,
            'ar'                    => null,
            'elevador'              => 20,
            '220v'                  => 192,
            '330v'                  => 193,
            'bifasico'              => 195,
            'trifasico'             => 196,
            'piscina'               => 58,
            'piso frio'             => null,
            'piso elevado'          => 260,
            'divisorias'            => 185,
            'carpete'               => 220,
            'beira mar'             => 205,
            'graos'                 => 159,
            'pecuaria'              => 55,
            'fruticultura'          => 207,
            'canal acucar'          => 113,
            'citrus'                => 206,
            'casa sede'             => 208,
            'casa colono'           => 209,
            'acude'                 => 210,
            'pivo irrigacao'        => 211,
            'granja'                => 114,
            'cerca'                 => 212,
            'estrada interna'       => 213,
            'baia cavalo'           => 214,
            'currais'               => 150,
            'tulha'                 => 187,
            'lavrador'              => 215,
            'estabulo'              => 153,
            'mangueiro'             => 216,
            'garagem maquinario'    => 217,
            'tanque peixe'          => 218,
            'piso laminado'         => null,
            'piso taco'             => 219,
            'piso taboa'            => null,
            'carpete madeira'       => null,
            'carpete nylon'         => null,
            'cimento queimado'      => null,
            'piso emborrachado'     => null,
            'piso ardosia'          => 198,
            'pomar'                 => 67,
            'turismo rural'         => 199,
            'artesiano'             => 104,
            'pista pouso'           => 200,
            'lago'                  => 44,
            'rio'                   => 202,
            'varanda gourmet'       => 92,
            'solarium'              => 85,
            'dormitorio reversivel' => 203,
            'piso aquecido'         => null,
            'contra piso'           => null,
            'piso granito'          => null,
            'piso marmore'          => null,
            'piso porcelanato'      => null,
            'sem comdomínio'        => 204,
            'copa'                  => 254,
            'banheiro empregada'    => 128,
            'armario cozinha'       => null,
            'armario closet'        => null,
            'armario banheiro'      => null,
            'portao'                => null,
            'gerador'               => 106,
            'altura pe direito'     => null,
            'area escritorio'       => null,
            'garagem caminhao'      => null,
            'barracao'              => null,
            'maquinario'            => null,
        ];

        foreach ($chars as $key => $value) {
            if (isset($model[$key])) {
                if ($this->simNaoToBool($this->booleanValue($model[$key]))) {
                    $characteristics[] = $value;
                }
            }
        }

        return !empty($characteristics) ? array_values(array_filter($characteristics)) : $characteristics;
    }

    private function getRoomsCount($model)
    {
        $roomsCount                   = new \stdClass();
        $roomsCount->dorm             = (int)$model['dormitorios'];
        $roomsCount->suit             = (int)$model['suites'];
        $roomsCount->bathroom         = (int)$model['banheiros'];
        $roomsCount->room             = (int)$model['salas'];
        $roomsCount->kitchen          = (int)$this->simNaoToBool($model['cozinha']);
        $roomsCount->parking_lot      = $model['finalidade'] == 'Comercial' ? ($model['garagens cobertas'] + $model['garagens descobertas']) : 0;
        $roomsCount->housekeeper_room = (int)$this->simNaoToBool($model['dormitorio empregada']);
        $roomsCount->lavatory         = (int)$this->simNaoToBool($model['lavabo']);
        $roomsCount->car_garage       = $model['finalidade'] !== 'Comercial' ? ($model['garagens cobertas'] + $model['garagens descobertas']) : 0;

        return $roomsCount;
    }
}