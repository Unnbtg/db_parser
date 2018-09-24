<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 12:00
 */

namespace Microsistec\DbParser\Parser\Imobex;


use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class PropertyParser extends AbstractParser implements ParserInterface
{
    private $types = [
        1  => 1, //Apartamento
        10 => 13, //Sítio
        11 => 14, //Fazenda
        15 => null, //Andar
        16 => 17, //Área
        17 => null, //Ilha
        18 => 36, //Hotel (fundo de comercio no sci)
        19 => 3, //Flat
        2  => 8, //Casa
        23 => 19, //Conjunto (conjunto comercial no sci)
        24 => null, //Depósito
        25 => 27, //Indústria
        26 => 23, //Sala
        27 => 36, //Comercial (fundo de comercio no sci)
        33 => 12, //Chácara
        43 => 22, //Galpão
        5  => 11, //Terreno
        6  => null, //Garagem
        60 => 9, //Sobrado
        7  => 30, //Prédio
        9  => 25, //Loja
    ];

    private $flag = [
        'A' => 1, //Disponivel eh ativo no sci
        'I' => 2, //indisponivel eh Bloqueado
    ];

    private $situation = [
        'D' => 1,
        'P' => 3,
        'I' => 2,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $property = new Property();

        $property->maintence_id     = (int)trim($model->imovel->linha->cd_imovel);
        $property->id               = (int)trim($model->imovel->linha->cd_imovel);
        $property->code             = (int)trim($model->imovel->linha->cd_imovel);
        $property->alternative_code = (string)trim($model->imovel->linha->referencia) ?: null;
        $property->old_type         = strtolower((string)trim($model->imovel->linha->tipo_imovel->linha->tipo_padrao->linha->ds_tipo_padrao));
        $property->finality         = 1; // 19/09/2018 - não temos o perfil do imóvel (res. com. ind. rural)
        $property->type             = $this->types[(int)trim($model->imovel->linha->tipo_padrao->linha->cd_tipo_padrao)];
        $property->status           = trim((string)trim($model->imovel->linha->situacao)) ? $this->flag[trim((string)trim($model->imovel->linha->situacao))] : 2;
        $property->subtype          = null;
        $property->for_rent         = $this->booleanValue((int)$model->negocio_imovel->linha->cd_negocio);
        $property->for_sale         = $this->booleanValue((int)$model->negocio_imovel->linha->cd_tipo_venda);
        $property->for_vacation     = $this->booleanValue((int)$model->negocio_imovel->linha->cd_tipo_aluguel);

        $property->situation                     = trim((string)trim($model->imovel->linha->ocupacao)) ? $this->situation[(string)trim($model->imovel->linha->ocupacao)] : null;
        $property->has_board                     = false;
        $property->zipcode                       = $this->unMask((string)trim($model->imovel->linha->cep));
        $property->state_id                      = null;
        $property->city_id                       = null;
        $property->neighborhood_id               = null;
        $property->zone                          = null;
        $property->street                        = title_case(trim((string)$model->imovel->linha->endereco)) ?: null;
        $property->block                         = null;
        $property->street_number                 = trim((string)$model->imovel->linha->numero);
        $property->complementary                 = title_case(trim((string)$model->imovel->linha->complemento)) ?: null;
        $property->city                          = title_case(trim((string)$model->imovel->linha->nm_cidade)) ?: null;
        $property->neighborhood                  = title_case(trim((string)$model->imovel->linha->nm_bairro)) ?: null;
        $property->neighborhood_commercial       = title_case(trim((string)$model->imovel->linha->nm_bairro)) ?: null;
        $property->state                         = strtoupper(trim((string)$model->imovel->linha->sg_estado)) ?: null;
        $property->condominium_name              = trim((string)$model->imovel->linha->nm_edificio) ?: null;
        $property->age                           = (int)$model->imovel->linha->ano_construcao > 0 ? (string)(date('Y') - (int)$model->imovel->linha->ano_construcao) : null;
        $property->floor                         = trim((string)$model->imovel->linha->pavimento) ?: null;
        $property->level                         = null;
        $property->sell_price                    = (double)$model->imovel->linha->valor_venda;
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
        $property->rent_price                    = (double)$model->imovel->linha->valor_locacao;
        $property->iptu_price                    = (double)$model->imovel->linha->iptu_preco;
        $property->condominium_price             = (double)$model->imovel->linha->condominio_preco;
        $property->fgts                          = $this->booleanValue((int)$model->imovel->linha->fgts);
        $property->letter_of_credit              = false;
        $property->bank_financing                = $this->booleanValue((int)$model->imovel->linha->financiamento);
        $property->direct_financing              = false;
        $property->lessor_bail                   = false;
        $property->guarantor                     = false;
        $property->deposit                       = false;
        $property->mcmv                          = false;
        $property->requires_guarantor_deed       = false;
        $property->keys                          = null;
        $property->keys_available                = false;
        $property->iptu_number                   = (string)$model->imovel->linha->nm_iptu ?: null;
        $property->energy_number                 = (string)$model->imovel->linha->nm_rel_luz ?: null;
        $property->water_number                  = (string)$model->imovel->linha->nm_rel_agua ?: null;
        $property->registration_number           = (string)$model->imovel->linha->nm_matricula ?: null;
        $property->registry                      = (string)$model->imovel->linha->cartorio ?: null;
        $property->deed_status                   = null;
        $property->receiver1_id                  = null;
        $property->receiver2_id                  = null;
        $property->indicator1                    = null;
        $property->indicator2                    = null;
        $property->area_width                    = floatval($model->imovel->linha->frente) ?: null;
        $property->area_height                   = floatval($model->imovel->linha->comprimento) ?: null;
        $property->total_area                    = floatval($model->imovel->linha->med_area_terreno) ?: null;
        $property->total_useful_area             = floatval($model->imovel->linha->med_area_util) ?: null;
        $property->total_built_area              = null;
        $property->built_area_price              = null;
        $property->total_area_price              = null;
        $property->relative_distance             = null;
        $property->relative_distance_to          = null;
        $property->reference_point               = trim((string)$model->imovel->linha->ponto_referencia) ?: null;
        $property->orientation                   = null;
        $property->website_home_highlight        = $this->simNaoToBool(trim((string)$model->imovel->linha->destacado));
        $property->website_rotative_banner       = false;
        $property->website_notes                 = strip_tags(html_entity_decode(html_entity_decode(trim((string)$model->imovel->linha->descricao))));
        $property->website_title                 = null;
        $property->website_keywords              = null;
        $property->website_description           = null;
        $property->notes                         = trim((string)$model->imovel->linha->obs);
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
        $property->exchange                 = $this->booleanValue((int)$model->imovel->linha->aceito_imovel);
        $property->advance_payment          = (double)$model->imovel->linha->entrada_preco;
        $property->advance_installments     = null;

        $property->contacts               = [];
        $property->features               = $this->addFeatures($model);
        $property->proximities            = $this->addProximities($model);
        $property->portals                = [];
        $property->publish                = false;
        $property->vacations              = [];
        $property->photos                 = [];
        $property->videos                 = [];
        $property->roomsCount             = $this->getRoomsCount($model);
        $property->roomFeatures           = (object)[];
        $property->created_at             = $this->formatDate((string)$model->imovel->linha->dt_criacao);
        $property->updated_at             = $this->formatDate((string)$model->imovel->linha->dt_last_changed);
        $property->deleted_at             = $this->simNaoToBool(trim((string)$model->imovel->linha->fl_deletado)) ? date('Y-m-d') : null;
        $property->base_uri               = null;
        $property->original               = null;
        $property->migration_obs          = null;
        $property->highlight_photo        = null;
        $property->measure_unit           = 1;
        $property->selling_exclusivity    = $this->booleanValue((int)$model->imovel->linha->fl_contrato_exclusividade);
        $property->exclusivity_start_date = $this->formatDate(trim((string)$model->imovel->linha->dt_ini_contrato_ex));
        $property->exclusivity_end_date   = null;
        $property->draft                  = false;
        $property->longitude              = (double)$model->imovel->linha->longitude;
        $property->latitude               = (double)$model->imovel->linha->latitude;
        $owner                            = [];
        if ($model->imovel_proprietario->linha->proprietario) {
            $owner[] = trim((int)$model->imovel_proprietario->linha->proprietario->linha->cd_proprietario);
        }
        $property->owners = $owner;

        return $property;
    }

    private function addFeatures($model)
    {
        $characteristics = [];

        $chars = [
            "1"   => 267, //Academia,
            //"10" => "Ar condicionado"(comodo),
            //"100" => "Piso parquê"(naum tem, comodo),
            //"101" => "Piso porcelanato"(comodo),
            //"102" => "Piso tabuão"(naum tem, comodo),
            //"103" => "Piso vinílico"(comodo),
            "104" => 67, //Pomar,
            "105" => 360, //Porta de segurança,
            "106" => 69, //"Portão elétrico",
            "107" => 361, //"Portão simples",
            "108" => 70, //"Portaria 12h",
            "109" => 319, //"Portaria 24h",
            "11"  => 256, //"Ar condicionado central",
            "110" => 362, //"Porteiro eletrônico",
            "111" => 73,//"Quadra de esportes",
            "112" => 71,//"Quadra de tênis",
            "113" => 147,//"Quintal",
            "114" => 363, //"Quiosque",
            "115" => 186,//"Recepção",
            "116" => 364, //"Refeitório",
            "117" => 365, //"Riacho",
            "118" => 75,//"Sacada",
            "119" => 13,//"Sala de cinema",
            "120" => 366, //"Sala de descanso",
            "121" => 367, //"Sala de espera",
            "122" => 368, //"Salão",
            "123" => 78,//"Salão de festas",
            "124" => 79,//"Salão de jogos",
            "125" => 80,//"Sauna",
            "126" => 246,//"Segurança" (segurança interna),
            "127" => 282,//"Segurança 24h",
            "128" => 369, //"Serviço de quarto",
            "129" => 370, //"Sistema de segurança",
            "13"  => 3,//"Área de serviço",
            "130" => 85,//"Solarium",
            "131" => 371, //"Sótão",
            "132" => 86,//"Spa",
            "133" => 88,//"Terraço",
            "134" => 286,//"TV a cabo",
            "135" => 91,//"Varanda",
            //"136" => "Ventilador de teto" (comodo),
            "137" => 66,//"Playground",
            //"14" => "Armários embutidos" (comodo),
            "15" => 372, //"Arroio",
            "16"  => 4,//"Ateliê",
            "17" => 373, //"Ático",
            "18"  => 290,//"Auditório",
            //"19" => "Banheira hidromassagem" (comodo),
            "2"   => 269,//"Acesso à internet",
            "20" => 374, //"Banheiro serviço",
            "21" => 375, //"Banheiro social",
            "22"  => 6,//"Bicicletário",
            "23"  => 7,//"Brinquedoteca",
            "24" => 376, //"Cabeamento estruturado",
            "25" => 377, //"Cabine de segurança",
            "26" => 378, //"Calefação",
            "27" => 379, //"Câmera de vigilância",
            "28"  => 9,//"Campo de futebol",
            "29"  => 121,//"Canil",
            "3"   => 210,//"Açude",
            "30" => 380, //"Centro de convenções",
            "31"  => 266,//"Cerca elétrica",
            "32"  => 12,//"Churrasqueira",
            "33" => 381, //"Churrasqueira a gás",
            "34" => 382, //"Churrasqueira coletiva",
            "35"  => 13,//"Cinema",
            "36" => 383, //"Circuito interno de TV",
            "37" => 384, //"Cisterna",
            //"38" => "Closet" (comodo),
            "39"  => 254,//"Copa",
            "4"   => 323,//"Adega",
            //"40" => "Cozinha americana" (comodo),
            "41" => 385, //"Deck de madeira",
            "42"  => 14,//"Deck molhado",
            //"43" => "Dependência de empregada" (comodo),
            "44" => 386, //"Depósito privativo",
            //"45" => "Despensa" (comodo),
            "46"  => 185,//"Divisórias",
            "47"  => 304,//"Edícula",
            "48" => 387, //"Elevador de carga",
            "49"  => 19,//"Elevador de serviço",
            "5" => 388, //"Antena coletiva",
            "50" => 389, //"Elevador panorâmico",
            "51"  => 225,//"Elevador privativo",
            "52"  => 20,//"Elevador social",
            "53" => 390, //"Energia elétrica",
            "54" => 391, //"Energia solar",
            "55" => 392, //"Entrada para carro",
            "56"  => 174,//"Escritório",
            "57"  => 23,//"Espaço gourmet",
            "58"  => 26,//"Espaço mulher",
            "59"  => 273,//"Espelho d'água",
            "6"   => 53,//"Antena parabólica",
            "60" => 393, //"Esquadria em alumínio",
            "61" => 394, //"Esquadria em madeira",
            "62" => 395, //"Esquadrias em PVC",
            "63" => 396, //"Estacionamento",
            "64"  => 295,//"Forno à lenha",
            "65" => 397, //"Forro de gesso",
            "66" => 398, //"Forro de madeira",
            "67" => 399, //"Forro de PVC",
            "68" => 400, //"Fraldário",
            //"69" => "Gabinete" (comodo),
            "7"   => 83,//"Aquecimento a gás",
            "70"  => 10,//"Gás central",
            "71" => 401, //"Gás individual",
            "72"  => 274,//"Gerador de energia",
            "73"  => 40,//"Guarita",
            "74"  => 201,//"Heliporto",
            "75"  => 136,//"Hidrômetro individual",
            "76"  => 269,//"Internet",
            "77"  => 134,//"Jardim",
            "78"  => 45,//"Lan house",
            "79"  => 296,//"Lareira",
            "8"   => 268,//"Aquecimento central",
            "80" => 402, //"Lareira a gás",
            "81"  => 46,//"Lavanderia coletiva",
            "82"  => 188,//"Mezanino",
            //"83" => "Móveis planejados" (comodo),
            "84" => 403, //"Muro",
            "85"  => 51,//"Nascente",
            "86" => 404, //"Parque infantil",
            "87" => 405, //"Pátio privativo",
            "88" => 406, //"Pilotis",
            "89"  => 58,//"Piscina",
            "9"   => 305,//"Aquecimento solar",
            "90"  => 59,//"Piscina adulto",
            "91" => 407, //"Piscina coberta climatizada",
            "92" => 408, //"Piscina com cascata",
            "93"  => 62,//"Piscina infantil",
            //"94" => "Piso cerâmica" (comodo),
            "95"  => 260,//"Piso elevado",
            //"96" => "Piso granito" (comodo),
            //"97" => "Piso laminado" (comodo),
            //"98" => "Piso madeira" (comodo),
            //"99" => "Piso mármore" (comodo),
        ];

        if ($model->imovel_caracteristica) {
            foreach ($model->imovel_caracteristica->linha as $char) {
                if (array_key_exists((string)$char->caracteristica->linha->cd_caracteristica, $chars)) {
                    $characteristics[] = $chars[(string)$char->caracteristica->linha->cd_caracteristica];
                }
            }
        }

        return $characteristics;
    }

    private function addProximities($model)
    {
        $proximities = [];

        $proxs = [
            "1"  => 1, //Academia,
            "10" => 17, //Supermercado,
            "11" => 9, //Igreja,
            "12" => 12, //Praça,
            "2"  => 2, //Banco,
            "3"  => 5, //Escola,
            "4" => 37, //Escola de idioma,
            "5" => 38, //Faculdade,
            "6"  => 6, //Farmácia,
            "7"  => 8, //Hospital,
            "8"  => 11, //Padaria,
            "9"  => 32, //Shopping,
        ];

        if ($model->imovel_recurso) {
            foreach ($model->imovel_recurso->linha as $char) {
                if (array_key_exists((string)$char->recurso->linha->cd_recurso, $proxs)) {
                    $proximities[] = $proxs[(string)$char->recurso->linha->cd_recurso];
                }
            }
        }

        return $proximities;
    }

    private function getRoomsCount($model)
    {
        $roomsCount                   = new \stdClass();
        $roomsCount->dorm             = (int)$model->imovel->linha->num_dormitorios;
        $roomsCount->suit             = (int)$model->imovel->linha->num_suites;
        $roomsCount->bathroom         = (int)$model->imovel->linha->num_banheiro;
        $roomsCount->room             = 0;
        $roomsCount->kitchen          = 0;
        $roomsCount->parking_lot      = 0;
        $roomsCount->housekeeper_room = 0;

        if ($model->imovel_caracteristica) {
            foreach ($model->imovel_caracteristica->linha as $char) {
                if((string)$char->caracteristica->linha->cd_caracteristica == '43') {
                    $roomsCount->housekeeper_room = 1;
                }
            }
        }

        $roomsCount->lavatory         = 0;
        $roomsCount->car_garage       = (int)$model->imovel->linha->num_vagas;

        return $roomsCount;
    }

}