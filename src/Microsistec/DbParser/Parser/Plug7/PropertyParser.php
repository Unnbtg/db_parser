<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 12:00
 */

namespace Microsistec\DbParser\Parser\Plug7;


use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class PropertyParser extends AbstractParser implements ParserInterface
{
    private $finalities = [
        0 => 1,
        1 => 1,
        2 => 2,
        3 => 1,
        4 => 1,
        5 => 3,
    ];

    private $types = [
        1  => 1,
        12 => 1,
        46 => 1,
        40 => 1,
        23 => 3,
        30 => 6,
        41 => 5,
        53 => 7,
        2  => 8,
        49 => 8,
        50 => 8,
        54 => 8,
        42 => 9,
        45 => 8,
        13 => 8,
        15 => 38,
        16 => 8,
        14 => 8,
        19 => 2,
        20 => 2,
        48 => 2,
        //11 => 2, //Andar Inteiro ???
        29 => 4,
        3  => 11,
        56 => 39,
        51 => 17,
        55 => 17,
        22 => 14,
        52 => 16,
        17 => 12,
        57 => 12,
        18 => 8,
        26 => 15,
        5  => 13,
        //35 => 11, // rural??
        21 => 36,
        38 => 23,
        36 => 24,
        39 => 23,
        4  => 24,
        33 => 36,
        43 => 30,
        44 => 19,
        31 => 25,
        27 => 36,
        34 => 36,
        32 => 18, //pavilhao vira barracao
        24 => 22,
        25 => null, //garagem??
        6  => 27,
        //28 => null, //outros
        //7  => null, //lancamento residencial
        //8  => null, //lancamento comercial
        //10 => null, //lancamento com servicos
        //9  => null, //lancamento misto
        47 => 38, //lancamento de casa de condominio vira casas de condominio
        58 => 11, //lote vira terreno
        //59 => null, //lancamento
    ];

    private $flag = [
        0 => 1, //Disponivel eh ativo no sci
        1 => 2, //indisponivel eh Bloqueado
        2 => 3, //vendido eh Vendido
        3 => 5, //alugado eh Alugado
        4 => 6, //arrendado eh reservado
        5 => 6, //pre cadastro eh reservado
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $property                   = new Property();
        $property->maintence_id     = (int)trim($model->id);
        $property->id               = (int)trim($model->id);
        $property->code             = (int)trim($model->id);
        $property->alternative_code = (string)trim($model->minha_referencia) ?: (int)trim($model->id);
        $property->old_type         = (string)trim($model->tipo_imovel_id);
        $property->finality         = $this->finalities[(int)trim($model->proposito_id)];

        $property->type             = $this->types[(int)trim($model->tipo_imovel_id)];
        $property->status           = $this->flag[(int)trim($model->status_imovel_id)];
        $property->subtype          = null;
        $property->for_rent         = $this->booleanValue((int)$model->locacao);
        $property->for_sale         = $this->booleanValue((int)$model->venda);
        $property->for_vacation     = $this->booleanValue((int)$model->temporada);

        $property->situation                     = null;
        $property->has_board                     = $this->booleanValue((int)$model->placa_local);
        $property->zipcode                       = $this->unMask((string)trim($model->cep));
        $property->state_id                      = null;
        $property->city_id                       = null;
        $property->neighborhood_id               = null;
        $property->zone                          = trim((string)$model->zone);
        $property->street                        = trim((string)$model->logradouro);
        $property->block                         = trim((string)$model->bloco);
        $property->street_number                 = (string)$model->numero;
        $property->complementary                 = (string)$model->complemento;
        $property->city                          = trim((string)$model->cidade);
        $property->neighborhood                  = trim((string)$model->bairro);
        $property->neighborhood_commercial       = trim((string)$model->bairro);
        $property->state                         = trim((string)$model->estado);
        $property->condominium_name              = (string)$model->nome != '' ? (string)$model->nome : null;
        $property->age                           = (int)$model->ano_construcao > 0 ? (string)(date('Y') - (int)$model->ano_construcao) : null;
        $property->floor                         = (string)$model->andar_numero;
        $property->level                         = null;
        $property->sell_price                    = (double)$model->venda_preco_minimo;
        $property->monthly_installments          = (int)$model->parcelas;
        $property->monthly_installments_value    = (double)$model->parcela_preco;
        $property->quarterly_installments        = null;
        $property->quarterly_installments_value  = null;
        $property->semiannual_installments       = null;
        $property->semiannual_installments_value = null;
        $property->annual_installments           = (int)$model->anual_parcela;
        $property->annual_installments_value     = (double)$model->anual_parcela_chave;
        $property->keys_installments             = null;
        $property->keys_installments_value       = (double)$model->valor_chave;
        $property->rent_price                    = (double)$model->aluguel_preco_min;
        $property->iptu_price                    = (double)$model->iptu_preco;
        $property->condominium_price             = (double)$model->condominio_preco;
        $property->fgts                          = $this->booleanValue((int)$model->fgts);
        $property->letter_of_credit              = false;
        $property->bank_financing                = $this->booleanValue((int)$model->financiamento);
        $property->direct_financing              = false;
        $property->lessor_bail                   = false;
        $property->guarantor                     = false;
        $property->deposit                       = false;
        $property->mcmv                          = $this->booleanValue((int)$model->financiamento_mcmv);
        $property->requires_guarantor_deed       = false;
        $property->keys                          = null;
        $property->keys_available                = false;
        $property->iptu_number                   = null;
        $property->energy_number                 = null;
        $property->water_number                  = null;
        $property->registration_number           = null;
        $property->registry                      = null;
        $property->deed_status                   = null;
        $property->receiver1_id                  = trim((int)$model->agente_primario);
        $property->receiver2_id                  = null;
        $property->indicator1                    = null;
        $property->indicator2                    = null;
        $property->area_width                    = floatval($model->largura_area);
        $property->area_height                   = floatval($model->altura_area);
        $property->total_area                    = floatval($model->total_area_minima);
        $property->total_useful_area             = floatval($model->area_util_minima);
        $property->total_built_area              = floatval($model->area_minima_construida);
        $property->built_area_price              = null;
        $property->total_area_price              = null;
        $property->relative_distance             = null;
        $property->relative_distance_to          = null;
        $property->reference_point               = trim((string)$model->referencia);
        $property->orientation                   = null;
        $property->website_home_highlight        = false;
        $property->website_rotative_banner       = false;
        $property->website_notes                 = strip_tags(html_entity_decode(html_entity_decode(trim((string)$model->descricao))));
        $property->website_title                 = trim((string)$model->titulo_web) ? trim((string)$model->titulo_web) : null;
        $property->website_keywords              = null;
        $property->website_description           = strip_tags(html_entity_decode(html_entity_decode(trim((string)$model->descricao))));
        $property->notes                         = strip_tags(html_entity_decode(html_entity_decode(trim((string)$model->observacao))));
        $property->user_id                       = trim((int)$model->agente_primario);
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
        $property->exchange                 = $this->booleanValue((int)$model->aceito_imovel);
        $property->advance_payment          = (double)$model->entrada_preco;
        $property->advance_installments     = null;

        $property->contacts                 = [];
        $property->features                 = $this->addFeatures($model);
        $property->proximities              = [];
        $property->portals                  = [];
        $property->publish                  = false;
        $property->vacations                = [];
        $property->photos                   = [];
        $property->videos                   = [];
        $property->roomsCount               = $this->getRoomsCount($model);
        $property->roomFeatures             = (object)[];
        $property->created_at               = null;
        $property->updated_at               = null;
        $property->base_uri                 = null;
        $property->original                 = null;
        $property->migration_obs            = null;
        $property->highlight_photo          = null;
        $property->measure_unit             = 1;
        $property->selling_exclusivity      = $this->booleanValue((int)$model->exclusivo);
        $property->exclusivity_start_date   = null;
        $property->exclusivity_end_date     = null;
        $property->draft                    = false;


        $query = \DB::connection('mongoconnection')->collection('imoveis_proprietarios');

        $owners = $query->where('property_id', $property->id)->project(['_id' => 0])->get()->toArray();
        $tmp = [];
        if (!is_null($owners) && !empty($owners)) {

            foreach ($owners as $owner) {
                $tmp[] = $owner['owner_id'];
            }
        }

        $property->owners = $tmp;

        return $property;
    }

    private function addFeatures($model)
    {
        $characteristics = [];

        $chars = [
            'area_servico' => 3,
            'elevador'      => 20,
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
        $roomsCount->dorm             = (int)$model->dormitorio;
        $roomsCount->suit             = (int)$model->suite;
        $roomsCount->bathroom         = (int)$model->banheiro;
        $roomsCount->room             = 0;
        $roomsCount->kitchen          = (int)$model->cozinha;
        $roomsCount->parking_lot      = 0;
        $roomsCount->housekeeper_room = (int)$model->det_dormemp;
        $roomsCount->lavatory         = (int)$model->det_Lavabo;
        $roomsCount->car_garage       = (string)$model->inf_SubTipo !== 'COMERCIAL' ? (int)$model->vaga + (int)$model->vaga_privada + (int)$model->vaga_coberta : 0;

        return $roomsCount;
    }

    public function getFlag($model)
    {
        if (!isset($this->flag[(string)$model->inf_Situacao])) {
            return 2; // bloqueado por padrão
        }

        return $this->flag[(string)$model->inf_Situacao];
    }

}