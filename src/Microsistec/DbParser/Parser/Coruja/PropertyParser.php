<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 06/02/18
 * Time: 10:47
 */

namespace Microsistec\DbParser\Parser\Coruja;

use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class PropertyParser extends AbstractParser implements ParserInterface
{
    private $types = [
        ["id" => 1, "name" => "apartamento", "prefix" => "AP", "finality" => [1]],
        ["id" => 8, "name" => "casa", "prefix" => "CA", "finality" => [1, 2]],
        ["id" => 11, "name" => "terreno", "prefix" => "TE", "finality" => [1, 2, 3, 4]],
        ["id" => 36, "name" => "comercial", "prefix" => "FU", "finality" => [2]], //Fundo de comercio no SCI
        ["id" => 12, "name" => "rural", "prefix" => "CH", "finality" => [4]],
        
        ["id" => 4, "name" => "Kitnet", "prefix" => "KI", "finality" => [1]],
        ["id" => 38, "name" => "Casa de Condomínio", "prefix" => "CAC", "finality" => [1]],
        ["id" => 2, "name" => "Cobertura", "prefix" => "CO", "finality" => [1]],
        ["id" => 23, "name" => "Sala", "prefix" => "SA", "finality" => [2]],
        ["id" => 9, "name" => "Sobrado", "prefix" => "SB", "finality" => [1, 2]],
        ["id" => 3, "name" => "Flat", "prefix" => "FL", "finality" => [1]],
    ];

    private $finalities = [
        'apartamento' => 1,
        'casa'        => 1,
        'comercial'   => 2,
        'terreno'     => 1,
        'rural'       => 4,
        'kitnet'      => 1,
        'casa de condomínio' => 1, 
        'cobertura' => 1, 
        'sala' => 1,
        'sobrado' => 1,
        'flat' => 1,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        if($model['TIPO'] == 3) {
            return;
        }
        $property = new Property();

        $property->maintence_id = $model['CODIGO'];
        $property->id           = $model['CODIGO'];
        $property->user_code    = $model['CODIGO'];
        $property->old_type     = $model['TIPO'];
        $property->code         = $model['CODIGO'];
        $property->type         = $this->getFromComplexConfig(strtolower($model['TIPO']), $this->types);
        try{
            $property->finality     = $this->finalities[strtolower($model['TIPO'])];
        } catch (\Exception $e) {
            dd($model);
        }


        $property->for_rent = false;
        if (strpos(strtolower($model['FINALIDADE']), 'locação') !== false) {
            $property->for_rent = true;
        }

        $property->for_sale = false;
        if (strpos(strtolower($model['FINALIDADE']), 'venda') !== false) {
            $property->for_sale = true;
        }

        $property->for_vacation = false;
        $property->has_board    = false;

        $property->zipcode                     = $this->unMask($model['CEP']);
        $property->state_id                    = null;
        $property->city_id                     = null;
        $property->neighborhood_id             = null;
        $property->alternative_neighborhood_id = null;
        $property->zone                        = null;
        $property->street                      = (string)$model['LOGRADOURO'];
        $property->block                       = (string)$model['BLOCO'];
        $property->street_number               = (string)$model['NUMERO'];
        $property->complementary               = $model['APTO'];
        $property->condominium_name            = $model['EDIFICIO'];
        $property->neighborhood                = $model['BAIRRO'];
        $property->city                        = $model['CIDADE'];
        $property->state                       = $model['UF'];
        $property->floor                       = (string)$model['PAVIMENTO'];
        $property->reference_point             = (string)$model['PONTO_REFERENCIA'];
        $property->sell_price                  = str_replace(',', '.', $model['VALOR_VENDA']);
        $property->rent_price                  = str_replace(',', '.', $model['VALOR_LOCACAO']);
        $property->iptu_price                  = str_replace(',', '.', $model['VALOR_IPTU']);
        $property->condominium_price           = str_replace(',', '.', $model['VALOR_CONDOMINIO']);
        $property->keys                        = $model['LOCAL_CHAVES'];
        $property->status                      = 1;

        $property->general_status = null;
        if ($model['LANCAMENTO'] == 1) {
            $property->general_status = 3;
        }

        if ($model['PRE_LANCAMENTO'] == 1) {
            $property->general_status = 2;
        }

        if ($model['EM_OBRAS'] == 1) {
            $property->general_status = 8;
        }

        if ($model['PRONTO_MORAR'] == 1) {
            $property->general_status = 4;
        }

        $property->deed_status = null;
        if ($model['ESCRITURADO'] == 1) {
            $property->deed_status = 7;
        }

        $property->registry = null;
        if ($model['REGISTRADO_CARTORIO'] == 1) {
            $property->registry = 'Possui Registro';
        }

        $property->area_width                    = $model['DIMENSAO_LADO_1'];
        $property->area_height                   = $model['DIMENSAO_LADO_2'];
        $property->total_useful_area             = str_replace(',', '.', $model['AREA_UTIL']);
        $property->total_area                    = str_replace(',', '.', $model['AREA_TOTAL']);
        $property->relative_distance             = null;
        $property->fgts                          = false;
        $property->letter_of_credit              = false;
        $property->bank_financing                = false;
        $property->direct_financing              = false;
        $property->lessor_bail                   = false;
        $property->guarantor                     = false;
        $property->deposit                       = false;
        $property->mcmv                          = false;
        $property->requires_guarantor_deed       = false;
        $property->keys_available                = strlen($model['LOCAL_CHAVES']) > 0 ? true : false;
        $property->website_home_highlight        = false;
        $property->website_rotative_banner       = false;
        $property->website_showcase              = false;
        $property->sales_authorization           = false;
        $property->opportunity                   = false;
        $property->exchange                      = false;
        /*$property->advance_payment               = str_replace(',', '.', $model['VALOR_ENTRADA']);
        $property->monthly_installments          = $model['QTD_MENSAIS'];
        $property->monthly_installments_value    = str_replace(',', '.', $model['VALOR_MENSAIS']);
        $property->keys_installments_value       = str_replace(',', '.', $model['VALOR_CHAVES']);
        $property->quarterly_installments        = $model['QTD_TRIMESTRAIS'];
        $property->quarterly_installments_value  = str_replace(',', '.', $model['VALOR_TRIMESTRAIS']);
        $property->semiannual_installments       = $model['QTD_SEMESTRAIS'];
        $property->semiannual_installments_value = str_replace(',', '.', $model['VALOR_SEMESTRAIS']);
        $property->annual_installments           = $model['QTD_ANUAIS'];
        $property->annual_installments_value     = str_replace(',', '.', $model['VALOR_ANUAIS']);
        $property->website_title                 = $model['TITULO_PAGINA'];
        $property->website_keywords              = $model['PALAVRAS_CHAVES'];
        $property->website_description           = $model['META_DESCRIPTION'];*/
        $property->website_notes                 = $model['DESCRICAO_NO_SITE'];
        $property->notes                         = $model['DESCRICAO_INTERNA'];
        $property->owners                        = [];
        $property->contacts                      = [];
        $property->features                      = [];
        $property->proximities                   = [];
        $property->portals                       = [];
        $property->publish                       = false;
        $property->vacations                     = [];
        $property->photos                        = [];
        $property->videos                        = [];
        $property->roomsCount                    = $this->getRoomsCount($model);
        $property->roomFeatures                  = [];
        $property->created_at                    = $this->formatDate($model['DATA_CADASTRO_2'], true);
        $property->updated_at                    = $this->formatDate($model['ALTERADO'], true);
        $property->juridical_owners              = [];

        return $property;

    }


    private function getRoomsCount($model)
    {
        $roomsCount                   = new \stdClass();
        $roomsCount->dorm             = (int)$model['DORMS'];
        $roomsCount->suit             = (int)$model['SUITES'];
        $roomsCount->bathroom         = (int)$model['BANHEIROS'];
        $roomsCount->room             = (int)$model['SALAS'];
        $roomsCount->parking_lot      = $model['TIPO'] == 'comercial' ? (int)$model['VAGAS'] : 0;
        $roomsCount->lavatory         = (int)$model['LAVABO'];
        $roomsCount->car_garage       = $model['TIPO'] !== 'comercial' ? (int)$model['VAGAS'] : 0;
        $roomsCount->housekeeper_room = 0;
        $roomsCount->kitchen          = 0;

        return $roomsCount;
    }

}