<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 01/10/18
 * Time: 14:06
 */

namespace Microsistec\DbParser\Parser\Tecimob;


use Microsistec\DbParser\Formatter;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class PropertyParser extends AbstractParser implements ParserInterface
{
    private $types = [
        'apartamento' => 1, //Apartamento
        'sitio'       => 13, //Sítio
        'flat'        => 3, //Flat
        'casa'        => 8, //Casa
        'terreno'     => 11, //Terreno
        'sobrado'     => 9, //Sobrado
        'predio'      => 30, //Prédio
        'chacara'     => null, 
        'sala_comercial' => 23, //Sala
        
    ];

    private $flag = [
        'disponivel' => 1, //Disponivel eh ativo no sci
        'vendido'    => 3, //vendido eh vendido
    ];

    private $subtypes = [
        'alto_padrao'      => null,
        'cobertura'        => null,
        'cobertura_duplex' => 8,
        'comercial'        => null,
        'em_condominio'    => null,
        'em_edificio'      => null,
        'chacara'          => null,
        'flat'             => null,
        'geminada'         => null,
        'geminado'         => null,
        'lote'             => null,
        'padrao'           => null,
        'quitinete'        => null,
        'sitio'            => null,
        'sobrado'          => null,
        'sobreposta'       => 11,
        'terrea'           => 14,
        'terreno'          => null,
        'terreo'           => 6,
    ];

    private $finalities = [
        'residencial' => 1,
        'comercial'   => 2,
        'rural'       => 4,
        'residencial/comercial' => 1, 
    ];

    private $general_status = [
        "futuro_lancamento" => 1,
        "pre_lancamento"    => 2,
        "lançamento"        => 3,
        "pronto_para_morar" => 4,
        "ultimas_unidades"  => 5,
        "revenda"           => 6,
        "na_planta"         => 7,
        "em_construcao"     => 8,
        "novo"              => 9,
        "seminovo"          => 10,
        "usado"             => 11,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $property = new Property();

        $property->maintence_id     = Formatter::intValue($model['id']);
        $property->id               = Formatter::intValue($model['id']);
        $property->code             = Formatter::intValue($model['id']);
        $property->alternative_code = Formatter::stringValue($model['referencia']);
        $property->old_type         = Formatter::stringValue(strtolower($model['tipo_do_imovel']));
        $property->finality         = $this->finalities[Formatter::stringValue(strtolower($model['perfil']))];
        $property->type             = $this->types[Formatter::stringValue(strtolower(Formatter::cleanSpecialChars($model['tipo_do_imovel'])))];
        $property->status           = isset($this->flag[Formatter::stringValue(strtolower(Formatter::cleanSpecialChars($model['situacao'])))]) ? $this->flag[Formatter::stringValue(strtolower(Formatter::cleanSpecialChars($model['situacao'])))] : 2;
        $property->subtype          = $this->subtypes[Formatter::stringValue(strtolower(Formatter::cleanSpecialChars($model['subtipo_do_imovel'])))];
        $property->for_rent         = Formatter::stringValue(strtolower(Formatter::cleanSpecialChars($model['titulo_de_transacao']))) == 'venda' ? true : false;
        $property->for_sale         = Formatter::stringValue(strtolower(Formatter::cleanSpecialChars($model['titulo_de_transacao']))) == 'locacao' ? true : false;
        $property->for_vacation     = Formatter::stringValue(strtolower(Formatter::cleanSpecialChars($model['titulo_de_transacao']))) == 'temporada' ? true : false;

        $property->situation                     = null;
        $property->has_board                     = Formatter::booleanValue($model['com_placa']);
        $property->zipcode                       = $this->unMask(Formatter::stringValue($model['cep']));
        $property->state_id                      = null;
        $property->city_id                       = null;
        $property->neighborhood_id               = null;
        $property->zone                          = null;
        $property->street                        = title_case(Formatter::stringValue($model['logradouro']));
        $property->block                         = null;
        $property->street_number                 = Formatter::stringValue($model['logradouro_numero']);
        $property->complementary                 = Formatter::stringValue($model['complemento']);
        $property->city                          = Formatter::stringValue($model['cidade']);
        $property->neighborhood                  = Formatter::stringValue($model['bairro']);
        $property->neighborhood_commercial       = Formatter::stringValue($model['bairro']);
        $property->state                         = Formatter::stringValue($model['uf']);
        $property->condominium_name              = Formatter::stringValue($model['nome_do_condominio']);
        $property->age                           = null;
        $property->floor                         = Formatter::stringValue(Formatter::cleanSpecialChars($model['andar']), 'nao_informado');
        $property->level                         = null;
        $property->general_status                = isset($this->general_status[Formatter::stringValue(Formatter::cleanSpecialChars($model['utilizacao']))]) ? $this->general_status[Formatter::stringValue(Formatter::cleanSpecialChars($model['utilizacao']))] : null;
        $property->sell_price                    = (double)$model['valor_total'];
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
        $property->rent_price                    = null;
        $property->iptu_price                    = (double)str_replace(',', '.', str_replace('.', '', $model['iptu']));
        $property->condominium_price             = (double)$model['valor_condominio'];
        $property->fgts                          = false;
        $property->letter_of_credit              = false;
        $property->bank_financing                = false;
        $property->direct_financing              = false;
        $property->lessor_bail                   = false;
        $property->guarantor                     = false;
        $property->deposit                       = false;
        $property->mcmv                          = false;
        $property->requires_guarantor_deed       = false;
        $property->keys_available                = Formatter::booleanValue($model['chave_disponivel']);
        $property->keys                          = Formatter::stringValue($model['onde_pegar_a_chave']);
        $property->iptu_number                   = null;
        $property->energy_number                 = null;
        $property->water_number                  = null;
        $property->registration_number           = null;
        $property->registry                      = null;
        $property->deed_status                   = Formatter::booleanValue($model['escriturada']) ? 1 : null;
        $property->receiver1_id                  = null;
        $property->receiver2_id                  = null;
        $property->indicator1                    = null;
        $property->indicator2                    = null;
        $property->area_width                    = floatval($model['medida_terreno_frente']) ?: null;
        $property->area_height                   = floatval($model['medida_terreno_fundo']) ?: null;
        $property->total_area                    = floatval($model['medida_terreno_total']) ?: null;
        $property->total_useful_area             = floatval($model['medida_area_privativa']) ?: null;
        $property->total_built_area              = floatval($model['medida_area_construida']) ?: null;
        $property->built_area_price              = null;
        $property->total_area_price              = null;
        $property->relative_distance             = null;
        $property->relative_distance_to          = null;
        $property->reference_point               = null;
        $property->orientation                   = null;
        $property->website_home_highlight        = false;
        $property->website_rotative_banner       = false;
        $property->website_notes                 = strip_tags(html_entity_decode(html_entity_decode(trim((string)$model['observacao']))));
        $property->website_title                 = null;
        $property->website_keywords              = null;
        $property->website_description           = null;
        $property->notes                         = trim((string)$model['observacao_privativa']);
        $property->user_id                       = -1;
        $property->branch_id                     = null;

        $property->website_showcase         = false;
        $property->incra_number             = null;
        $property->incra_price              = null;
        $property->sales_authorization      = false;
        $property->authorization_start_date = null;
        $property->authorization_end_date   = null;
        $property->lease_price              = null;
        $property->ground_type              = null;
        $property->opportunity              = false;
        $property->exchange                 = false;
        $property->advance_payment          = null;
        $property->advance_installments     = null;

        $property->contacts = [];

        $property->features               = $this->addFeatures($model);
        $property->proximities            = $this->addProximities($model);
        $property->portals                = [];
        $property->publish                = Formatter::booleanValue($model['mostra_imovel_no_site']);
        $property->vacations              = [];
        $property->photos                 = [];
        $property->videos                 = $model['youtube'] ? [$model['youtube']] : [];
        $property->roomsCount             = $this->getRoomsCount($model);
        $property->roomFeatures           = (object)[];
        $property->created_at             = $this->formatDate((string)$model['data_de_cadastro']);
        $property->updated_at             = null;
        $property->deleted_at             = null;
        $property->base_uri               = null;
        $property->original               = null;
        $property->migration_obs          = null;
        $property->highlight_photo        = null;
        $property->measure_unit           = 1;
        $property->selling_exclusivity    = Formatter::booleanValue((int)$model['exclusividade']);
        $property->exclusivity_start_date = $this->formatDate(trim((string)$model['exclusividade_ate']));
        $property->exclusivity_end_date   = null;
        $property->draft                  = false;
        $property->longitude              = null;
        $property->latitude               = null;
        $property->owners                 = [];

        if ($model['proprietario']) {

            $query = \DB::connection('mongoconnection')->collection('customer');

            $owners = $query->where('name', Formatter::stringValue(title_case($model['proprietario'])))->project(['_id' => 0])->get()->toArray();
            $tmp    = [];
            if (!is_null($owners) && !empty($owners) && count($owners) == 1) {
                foreach ($owners as $owner) {
                    $tmp[] = $owner['id'];
                }
            }

            $property->owners = $tmp;
        }

        if (trim($model['numero_apartamento'])) {
            $property->notes .= ' - Apto n. ' . trim($model['numero_apartamento']);
        }

        return $property;
    }

    private function addFeatures($model)
    {
        $characteristics = [];

        $arr = array_map('trim', explode(',', strtolower($model['caracteristicas'])));

        $chars = [
            'jardim'                => 134,
            //'murado' => 1000,
            'quintal'               => 147,
            'churrasqueira'         => 12,
            'gás individual'        => 401,
            'interfone'             => 43,
            'portao automático'     => 69,
            'sacada'                => 75,
            //'tempo de construção' => 1000,
            'área de lazer'         => 356,
            'piscina'               => 58,
            'academia'              => 267,
            //'ar condicionado' => 1000,
            'elevador'              => 20,
            'espaço gourmet'        => 23,
            'portaria'              => 70,
            'estacionamento'        => 396,
            'salão de festas'       => 78,
            'sauna'                 => 80,
            'lavanderia'            => 146,
            //'lago de água natural' => 1000,
            'rio'                   => 202,
            //'armário de praia' => 1000,
            //'forno' => 1000,
            'forno à lenha'         => 295,
            'circuito de segurança' => 123,
            //'espaço kids' => 1000,
            'playground'            => 66,
            'solarium'              => 85,
            'cinema'                => 13,
            //'sala de tv' => 1000,
            'sistema de alarme'     => 285,
            'interfone'             => 43,
            //'área esportiva' => 1000,
            'deck molhado'          => 14,
            'lareira'               => 296,
            'spa'                   => 86,
            'vigia'                 => 93,
            'hidrômetro individual' => 136,
            'internet'              => 269,
            //'varal externo' => 1000,
            'gás central'           => 10,
            'grama'                 => 275,
        ];

        if ($arr) {
            foreach ($arr as $condchar) {
                if (array_key_exists($condchar, $chars)) {
                    $characteristics[] = $chars[$condchar];
                }
            }
        }

        $condChars = [
            'academia de ginástica' => 267,
            //'armário de praia' => 1000,
            'bicicletário'          => 6,
            'brinquedoteca'         => 7,
            'cerca elétrica'        => 266,
            'churrasqueira'         => 12,
            'cinema'                => 13,
            'elevador de serviço'   => 19,
            'elevador social'       => 20,
            'espaço de convivência' => 251,
            'espaço grill'          => 24,
            //'espaço kids' => 1000,
            'interfone'             => 43,
            'mini campo futebol'    => 9,
            'piscina adulto'        => 59,
            'piscina aquecida'      => 60,
            'piscina infantil'      => 62,
            'playground'            => 66,
            'portaria 24 horas'     => 319,
            'porteiro eletrônico'   => 362,
            'portão elétrico'       => 69,
            'quadra de tênis'       => 71,
            'quadra poliesportiva'  => 73,
            'sala de jogos'         => 79,
            //'sala de tv' => 1000,
            //'sala multiuso' => 1000,
            'salão de festas'       => 78,
            'sauna seca'            => 243,
            'serviço de praia'      => 81,
            'terraço gourmet'       => 324,
            //'área recreação infantil' => 1000,
        ];

        $arrCondChar = array_map('trim', explode(',', strtolower($model['caracteristicas_do_condominio'])));

        if ($arrCondChar && !empty($arrCondChar)) {
            foreach ($arrCondChar as $condchar) {
                if (array_key_exists($condchar, $condChars) && !in_array($condChars[$condchar], $characteristics)) {
                    $characteristics[] = $condChars[$condchar];
                }
            }
        }

        return $characteristics;
    }

    private function addProximities($model)
    {
        $proximities = [];

        $recursos = array_map('trim', explode(',', strtolower($model['recursos_proximos'])));

        $proxs = [
            'banco'                    => 2,
            //'Edifício frente ao mar' => 1000,
            'escola de idioma'         => 37,
            'escola'                   => 5,
            'faculdade'                => 38,
            'farmácia'                 => 6,
            'feira livre'              => 7,
            //'Fórum' => 1000,
            'hospital'                 => 8,
            'igreja'                   => 9,
            'padaria'                  => 11,
            //'Pontos Turísticos' => 1000,
            'posto de gasolina'        => 15,
            //'Praça' => 1000,
            //'Pronto Socorro Municipal' => 1000,
            'próximo a praia'          => 33,
            //'Próximo a via comercial' => 1000,
            'próximo centro comercial' => 34,
            //'Próximo Colônia de Férias' => 1000,
            'próximo à praia'          => 33,
            //'Quiosques de Praia' => 1000,
            //'Repartições Públicas' => 1000,
            'shopping'                 => 32,
            'supermercado'             => 17,
            //'Teatro Municipal' => 1000,
            //'Terminal de ônibus' => 1000,
            //'Transportes Públicos' => 1000,
            //'Unidade INSS' => 1000,
            //'Vista para o mar' => 1000,
        ];

        if ($recursos) {
            foreach ($recursos as $recurso) {
                if (array_key_exists($recurso, $proxs)) {
                    $proximities[] = $proxs[$recurso];
                }
            }
        }

        return $proximities;
    }

    private function getRoomsCount($model)
    {
        $roomsCount                   = new \stdClass();
        $roomsCount->dorm             = (int)$model['dormitorios'];
        $roomsCount->suit             = (int)$model['sendo_suite'];
        $roomsCount->bathroom         = (int)$model['banheiros'];
        $roomsCount->room             = (int)$model['sala_de_jantar'] + (int)$model['sala_de_tv'] + (int)$model['sala_de_estar'];
        $roomsCount->kitchen          = (int)$model['cozinhas'];
        $roomsCount->parking_lot      = 0;
        $roomsCount->housekeeper_room = (int)$model['dependencia_empregada'];
        $roomsCount->lavatory         = (int)$model['lavabo'];
        $roomsCount->car_garage       = (int)$model['garagens'];

        return $roomsCount;
    }
}