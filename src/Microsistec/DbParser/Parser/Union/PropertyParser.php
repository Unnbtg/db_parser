<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 12:00
 */

namespace Microsistec\DbParser\Parser\Union;


use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class PropertyParser extends AbstractParser implements ParserInterface
{
    private $finalities = [
        ["id" => 1, "name" => "residencial"],
        ["id" => 2, "name" => "comercial"],
        ["id" => 3, "name" => "industrial"],
        ["id" => 4, "name" => "rural"],
    ];

    private $types = [
        ["id" => 1, "name" => "apartamento", "prefix" => "ap", "finality" => [1]],
        ["id" => 1, "name" => "apartamento duplex", "prefix" => "ap", "finality" => [1]],  //apartamento duplex no ivalue, vira apto no sci
        ["id" => 2, "name" => "cobertura", "prefix" => "co", "finality" => [1]],
        ["id" => 3, "name" => "flat", "prefix" => "fl", "finality" => [1]],
        ["id" => 4, "name" => "kitnet", "prefix" => "ki", "finality" => [1]], //kitchinete no sci
        ["id" => 5, "name" => "penthouse", "prefix" => "pe", "finality" => [1]],
        ["id" => 6, "name" => "loft", "prefix" => "lf", "finality" => [1]],
        ["id" => 7, "name" => "studio", "prefix" => "st", "finality" => [1]],
        ["id" => 8, "name" => "casa", "prefix" => "ca", "finality" => [1, 2]],
        ["id" => 9, "name" => "sobrado", "prefix" => "sb", "finality" => [1, 2]],
        ["id" => 10, "name" => "loteamento", "prefix" => "lo", "finality" => [1, 2, 3, 4]],
        ["id" => 11, "name" => "terreno", "prefix" => "te", "finality" => [1, 2, 3, 4]],
        ["id" => 12, "name" => "chacara", "prefix" => "ch", "finality" => [4]],
        ["id" => 13, "name" => "sitio", "prefix" => "si", "finality" => [4]],
        ["id" => 14, "name" => "fazenda", "prefix" => "fa", "finality" => [4]],
        ["id" => 15, "name" => "haras", "prefix" => "ha", "finality" => [4]],
        ["id" => 16, "name" => "rancho", "prefix" => "ra", "finality" => [4]],
        ["id" => 17, "name" => "area", "prefix" => "ar", "finality" => [2, 3]],
        ["id" => 18, "name" => "barracao", "prefix" => "az", "finality" => [2, 3]], //armazem/barracao no sci
        ["id" => 19, "name" => "conjunto comercial", "prefix" => "cc", "finality" => [2]],
        ["id" => 20, "name" => "conjunto industrial", "prefix" => "ci", "finality" => [3]],
        ["id" => 21, "name" => "galeria", "prefix" => "gl", "finality" => [2]],
        ["id" => 22, "name" => "galpao", "prefix" => "gp", "finality" => [2, 3]],
        ["id" => 23, "name" => "sala", "prefix" => "sa", "finality" => [2]],
        ["id" => 24, "name" => "salao", "prefix" => "slo", "finality" => [2]],
        ["id" => 25, "name" => "loja", "prefix" => "lj", "finality" => [2]],
        ["id" => 26, "name" => "laje corporativa", "prefix" => "la", "finality" => [2]],
        ["id" => 27, "name" => "industria", "prefix" => "in", "finality" => [3]],
        ["id" => 28, "name" => "jazidas", "prefix" => "ja", "finality" => [3]],
        ["id" => 29, "name" => "pch", "prefix" => "pch", "finality" => [3]],
        ["id" => 30, "name" => "predio", "prefix" => "pr", "finality" => [1, 2, 3]],
        ["id" => 31, "name" => "mineradora", "prefix" => "mi", "finality" => [3]],
        ["id" => 32, "name" => "pedreira", "prefix" => "pd", "finality" => [3]],
        ["id" => 33, "name" => "sobreloja", "prefix" => "sl", "finality" => [2]],
        ["id" => 34, "name" => "uhe", "prefix" => "uhe", "finality" => [3]],
        ["id" => 35, "name" => "usina", "prefix" => "us", "finality" => [3]],
        ["id" => 36, "name" => "ponto", "prefix" => "fu", "finality" => [2]], //fundo de comercio no sci
        ["id" => 36, "name" => "pousada", "prefix" => "fu", "finality" => [2]], //fundo de comercio no sci
        ["id" => 36, "name" => "comercial", "prefix" => "fu", "finality" => [2]], //fundo de comercio no sci
    ];

    private $situation = [
        ["id" => 3, "name" => "PROPRIETÁRIO"],
        ["id" => 3, "name" => "INQUILINO"],
        ["id" => 3, "name" => "CONSTRUTORA"],
    ];

    private $orientation = [
        ["id" => 1, "name" => "frente"],
        ["id" => 2, "name" => "lateral"],
        ["id" => 3, "name" => "fundos"],
        ["id" => 4, "name" => "norte"],
        ["id" => 5, "name" => "norte/leste"],
        ["id" => 6, "name" => "norte/oeste"],
        ["id" => 7, "name" => "sul"],
        ["id" => 8, "name" => "sul/leste"],
        ["id" => 9, "name" => "sul/oeste"],
        ["id" => 10, "name" => "leste"],
        ["id" => 11, "name" => "oeste"],
    ];

    private $flag = [
        'ATIVO'        => 1, //Ativo
        'EM AVALIAÇÃO' => 2, //Bloqueado (EM AVALIAÇÃO no union)
        'VENDIDO'      => 3, //Vendido
        'INATIVO'      => 4, //Suspenso
        'LOCADO'       => 5, //Alugado
        'EM VALIDAÇÃO' => 6, //Reservado (EM VALIDAÇÃO no union)
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $property                   = new Property();
        $property->maintence_id     = (int)trim($model->pkImovel);
        $property->id               = (int)trim($model->pkImovel);
        $property->code             = (int)trim($model->inf_Referencia);
        $property->alternative_code = null;
        $property->user_code        = (int)trim($model->inf_Referencia);
        $property->old_type         = (string)trim($model->inf_Tipo);
        $property->finality         = $this->getFromComplexConfig(strtolower((string)trim($model->inf_SubTipo)), $this->finalities) ? $this->getFromComplexConfig(strtolower((string)trim($model->inf_SubTipo)), $this->finalities) : 1;
        if ((string)trim($model->inf_Tipo) == 'COMERCIAL') {
            $property->finality = 2;
        }
        $property->type    = $this->getFromComplexConfig(strtolower((string)trim($model->inf_Tipo)), $this->types);
        $property->subtype = null;

        $property->for_rent     = $this->booleanValue((int)$model->inf_Locacao);
        $property->for_sale     = $this->booleanValue((int)$model->inf_Venda);
        $property->for_vacation = $this->booleanValue((int)$model->inf_Temporada);

        $property->situation                     = $this->getFromComplexConfig((string)trim($model->inf_Ocupacao), $this->situation) ? $this->getFromComplexConfig((string)trim($model->inf_Ocupacao), $this->situation) : null;
        $property->has_board                     = $this->booleanValue((int)$model->loc_PlacaLocal);
        $property->zipcode                       = $this->unMask((string)trim($model->inf_Cep));
        $property->state_id                      = null;
        $property->city_id                       = null;
        $property->neighborhood_id               = null;
        $property->zone                          = trim((string)$model->inf_Regiao);
        $property->street                        = trim((string)$model->inf_Endereco);
        $property->block                         = null;
        $property->street_number                 = (string)$model->inf_Numero;
        $property->complementary                 = (string)$model->inf_Complemento;
        $property->condominium_name              = (string)$model->inf_Edificio;
        $property->age                           = (int)$model->Cap_AnoConstru > 0 ? (string)(date('Y') - (int)$model->Cap_AnoConstru) : null;
        $property->floor                         = (string)$model->det_AptoAndar;
        $property->level                         = null;
        $property->sell_price                    = (double)$model->inf_ValVenda;
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
        $property->rent_price                    = (double)$model->inf_ValLocacao;
        $property->iptu_price                    = (double)$model->Cap_ValIptu;
        $property->condominium_price             = (double)$model->Cap_ValCondominio;
        $property->fgts                          = false;
        $property->letter_of_credit              = false;
        $property->bank_financing                = $this->booleanValue((int)$model->inf_aceitaf);
        $property->direct_financing              = false;
        $property->lessor_bail                   = false;
        $property->guarantor                     = false;
        $property->deposit                       = false;
        $property->mcmv                          = false;
        $property->requires_guarantor_deed       = false;
        $property->keys                          = trim((string)$model->Cap_LocalChaves);
        $property->keys_available                = false;
        $property->iptu_number                   = (string)$model->cnf_CadPref;
        $property->energy_number                 = (string)$model->cnf_Eletricidade;
        $property->water_number                  = (string)$model->cnf_Agua;
        $property->registration_number           = null;
        $property->registry                      = (string)$model->cnf_CartorioImoveis;
        $property->deed_status                   = null;
        $property->receiver1_id                  = null;
        $property->receiver2_id                  = null;
        $property->indicator1                    = null;
        $property->indicator2                    = null;
        $area                                    = $this->parseArea($model);
        $property->area_width                    = floatval($area['width']);
        $property->area_height                   = floatval($area['height']);
        $property->total_area                    = floatval($model->det_AreaTotal);
        $property->total_useful_area             = floatval($model->det_AreaUtil);
        $property->total_built_area              = floatval($model->det_AreaConst);
        $property->built_area_price              = null;
        $property->total_area_price              = null;
        $property->relative_distance             = null;
        $property->relative_distance_to          = null;
        $property->reference_point               = trim((string)$model->inf_pontoref);
        $property->orientation                   = $this->getFromComplexConfig(strtolower(trim((string)$model->det_face)), $this->orientation) ? $this->getFromComplexConfig(strtolower(trim((string)$model->det_face)), $this->orientation) : null;
        $property->website_home_highlight        = $this->booleanValue((int)$model->int_PubSite);
        $property->website_rotative_banner       = false;
        $property->website_notes                 = trim((string)$model->int_AnuncioInternet);
        $property->website_title                 = trim((string)$model->int_title) ? trim((string)$model->int_title) : null;
        $property->website_keywords              = trim((string)$model->int_metatag);
        $property->website_description           = trim((string)$model->int_metadescription);
        $property->notes                         = trim((string)$model->inf_Descricao);
        $property->user_id                       = trim((int)$model->fkcaptador);
        $property->branch_id                     = null;
        $property->status                        = $this->getFlag($model);

        $property->website_showcase         = false;
        $property->incra_number             = null;
        $property->incra_price              = null;
        $property->sales_authorization      = $this->booleanValue((int)$model->inf_aut_pub);
        $property->authorization_start_date = null;
        $property->authorization_end_date   = null;
        $property->lease_price              = null;
        $property->ground_type              = null;
        $property->opportunity              = $this->booleanValue((int)$model->int_OptNegocio);
        $property->exchange                 = $this->booleanValue((int)$model->inf_Permuta);
        $property->advance_payment          = null;
        $property->advance_installments     = null;
        $property->owners                   = [(int)$model->fk_codcli];
        $property->contacts                 = [];
        $property->features                 = $this->addFeatures($model);
        $property->proximities              = [];
        $property->portals                  = [];
        $property->publish                  = $this->booleanValue((int)$model->int_PubSite);
        $property->vacations                = [];
        $property->photos                   = [];
        $property->videos                   = [];
        $property->roomsCount               = $this->getRoomsCount($model);
        $property->roomFeatures             = (object)[];
        $property->created_at               = $this->formatDate((string)$model->Cap_CadEm);
        $property->updated_at               = $this->formatDate((string)$model->Cap_AtuaEm);
        $property->base_uri                 = null;
        $property->original                 = null;
        $property->migration_obs            = null;
        $property->highlight_photo          = null;
        $property->measure_unit             = 1;
        $property->selling_exclusivity      = $this->booleanValue((int)$model->Cap_ContExclu);
        $property->exclusivity_start_date   = $this->formatDate((string)$model->Cap_DtInicio) ?: null;
        $property->exclusivity_end_date     = $this->formatDate((string)$model->Cap_DtFim) ?: null;
        $property->city                     = trim((string)$model->inf_Cidade);
        $property->neighborhood             = trim((string)$model->inf_bairrores);
        $property->neighborhood_commercial  = trim((string)$model->inf_Bairro);
        $property->state                    = trim((string)$model->inf_Uf);
        $property->draft                    = false;

        return $property;
    }

    private function parseArea($model)
    {
        $area             = (string)$model->det_DimTerreno;
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
        if (!isset($this->flag[(string)$model->inf_Situacao])) {
            return 2; // bloqueado por padrão
        }

        return $this->flag[(string)$model->inf_Situacao];
    }

    private function addFeatures($model)
    {
        $characteristics = [];

        $chars = [
            'det_academia'      => 267,
            'det_playground'    => 66,
            'det_quadrasquash'  => 300,
            'det_quadratenis'   => 71,
            'det_frentemar'     => 30,
            'det_salaofesta'    => 78,
            'det_salaofestainf' => 78,
            'det_piscinfantil'  => 62,
            'det_piscaquecida'  => 60,
            'det_salaginastica' => 77,
            'det_salaojogos'    => 79,
            'det_sauna'         => 80,
            'det_pomar'         => 67,
            'det_spa'           => 86,
            'det_brinquedoteca' => 7,
            'det_fornopp'       => 29,
            'det_espmulher'     => 26,
            'det_vestiario'     => 172,
            'det_solarium'      => 85,
            'det_fitness'       => 302,
            'det_dog'           => 57,
            'det_churrasqueira' => 12,
            'det_quadrapoli'    => 73,
            'det_piscina'       => 58,
            'det_cercaelet'     => 266,
            'det_lago'          => 44,
            'det_praca'         => 251,
            'det_heliporto'     => 201,
            'det_saunaseca'     => 243,
            'det_campogolf'     => 292,
            'det_ofuro'         => 297,
            'det_lanhouse'      => 45,
            'det_bocha'         => 63,
            'det_cinema'        => 13,
            'det_alarmemoni'    => 2,
            'det_deposito'      => 253,
            'det_edicula'       => 304,
            'det_gascentral'    => 10,
            'det_interfone'     => 43,
            'det_portaoelet'    => 69,
            'det_portaria'      => 70,
            'det_portaria24h'   => 319,
            'det_seguranca'     => 123,
            'det_terraco'       => 88,
            'det_zelador'       => 171,
            'det_elevador'      => 20,
            'det_elevadorserv'  => 19,
            'det_elevadorsoc'   => 20,
            'det_jardim'        => 134,
            'det_campofutebol'  => 9,
        ];

        foreach ($chars as $key => $value) {

            if (property_exists($model, $key)) {
                if ($this->simNaoToBool($this->booleanValue($model->$key))) {
                    $characteristics[] = $value;
                }
            }
        }

        return !empty($characteristics) ? array_values(array_filter($characteristics)) : $characteristics;
    }

    private function getRoomsCount($model)
    {
        $roomsCount                   = new \stdClass();
        $roomsCount->dorm             = (int)$model->det_Dormitorios;
        $roomsCount->suit             = (int)$model->det_Suite;
        $roomsCount->bathroom         = (int)$model->det_banheiro;
        $roomsCount->room             = (int)$model->det_Sala;
        $roomsCount->kitchen          = (int)$model->det_Cozinha;
        $roomsCount->parking_lot      = (string)$model->inf_SubTipo == 'COMERCIAL' ? ((int)$model->det_garagenscob + (int)$model->det_garagensdescob) : 0;
        $roomsCount->housekeeper_room = (int)$model->det_dormemp;
        $roomsCount->lavatory         = (int)$model->det_Lavabo;
        $roomsCount->car_garage       = (string)$model->inf_SubTipo !== 'COMERCIAL' ? ((int)$model->det_garagenscob + (int)$model->det_garagensdescob) : 0;

        return $roomsCount;
    }

}