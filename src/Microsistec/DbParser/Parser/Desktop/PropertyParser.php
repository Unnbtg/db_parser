<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 3/13/17
 * Time: 6:02 PM
 */

namespace Microsistec\DbParser\Parser\Desktop;

use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Apartment;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Commercial;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\House;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Land;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Rural;
use Microsistec\DbParser\Parser\OldParser;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class PropertyParser extends OldParser implements ParserInterface
{

    private $flag = [
        0  => 1, //Livre
        3  => 2, //Bloqueado
        5  => 3, //Vendido
        8  => 4, //Suspenso
        10 => 5, //Alugado
        11 => 6, //Reservado
        12 => 7, //Vendido Terceiros
        13 => 8, //Alugado Terceiros
        14 => 9, //Baixado
    ];


    public function parse($model, $domain = "", $account = "")
    {
        $typeInstance = $this->getInstanceByType($model);

        $types = $typeInstance->getTypeSubtype($model);

        $property                                = new Property();
        $property->maintence_id                  = (int)$model->id;
        $property->id                            = (int)$model->id;
        $property->code                          = (int)$model->code;
        $property->alternative_code              = $model->alternative_code;
        $property->user_code                     = (int)$model->code;
        $property->old_type                      = $model->type;
        $property->status                        = $this->getFlag($model);
        $property->finality                      = $this->getFinality($model);
        $property->type                          = (int)$types['tipo'];
        $property->subtype                       = (int)$types['subtipo'];
        $property->for_sale                      = (bool)substr($model->finality, 0, 1);
        $property->for_rent                      = (bool)substr($model->finality, 1, 1);
        $property->for_vacation                  = (bool)substr($model->finality, 2, 1);
        $property->situation                     = $model->situation != '' ? $model->situation + 1 : null;
        $property->has_board                     = (bool)$model->has_board;
        $property->zipcode                       = $this->unMask($model->zipcode);
        $property->zone                          = $model->zone;
        $property->street                        = $model->street;
        $property->block                         = $model->block;
        $property->street_number                 = $model->street_number;
        $property->city                          = $model->city;
        $property->neighborhood                  = $model->neighborhood;
        $property->state                         = $model->uf;
        $property->complementary                 = $model->complementary;
        $property->condominium_name              = $model->condominium_name;
        $property->age                           = $model->age;
        $property->floor                         = $model->floor;
        $property->reference_point               = $model->reference_point;
        //(?:((?:\d+)?(?:[\,\.]\d+)*(?:[\.\,]))(\d+)?)
        $property->sell_price                    = str_replace(',', '.', $model->sell_price);
        $property->monthly_installments          = (int)$model->monthly_qtd;
        $property->monthly_installments_value    = str_replace(',', '.', $model->monthly_value);
        $property->quarterly_installments        = (int)$model->quartely_qtd;
        $property->quarterly_installments_value  = str_replace(',', '.', $model->quartely_value);
        $property->semiannual_installments       = (int)$model->semiannual_qtd;
        $property->semiannual_installments_value = str_replace(',', '.', $model->semiannual_value);
        $property->annual_installments           = (int)$model->annual_qtd;
        $property->annual_installments_value     = str_replace(',', '.', $model->annual_value);
        $property->keys_installments             = (int)$model->keys_qtd;
        $property->keys_installments_value       = str_replace(',', '.', $model->keys_value);
        $property->advance_payment               = (int)$model->advance_payment;
        $property->rent_price                    = str_replace(',', '.', $model->rent_price);
        $property->iptu_price                    = str_replace(',', '.', $model->iptu_price);
        $property->condominium_price             = str_replace(',', '.', $model->condominium_price);
        $property->migration_obs                 = $model->migration_obs;

        $property->fgts                          = false;
        $property->letter_of_credit              = false;
        $property->bank_financing                = false;
        $property->direct_financing              = false;
        $property->lessor_bail                   = false;
        $property->guarantor                     = false;
        $property->deposit                       = false;
        $property->requires_guarantor_deed       = false;
        $property->exchange                      = false;


        if($model->payment_options != ''){
            $property->fgts                          = (bool)substr($model->payment_options, 0, 1);
            $property->letter_of_credit              = (bool)substr($model->payment_options, 1, 1);
            $property->bank_financing                = (bool)substr($model->payment_options, 13, 1);
            $property->direct_financing              = (bool)substr($model->payment_options, 12, 1);
            $property->lessor_bail                   = (bool)substr($model->payment_options, 4, 1);
            $property->guarantor                     = (bool)substr($model->payment_options, 5, 1);
            $property->deposit                       = (bool)substr($model->payment_options, 6, 1);
            $property->requires_guarantor_deed       = (bool)substr($model->payment_options, 7, 1);
            $property->exchange                      = (bool)strstr(substr($model->payment_options, 8, 4),"1");
        }

        $property->mcmv = false;
        $property->measure_unit = $this->getMeasureInfo($model);

        if($model->type != 4) {
            $property->mcmv = (bool)$model->mcmv;
        }

        $property->keys                          = $model->keys;
        $property->keys_available                = ($model->keys != '') ? true : false;
        $property->iptu_number                   = $model->iptu_number;
        $property->energy_number                 = $model->energy_number;
        $property->water_number                  = $model->water_number;
        $property->registration_number           = $model->registration_number;
        $property->deed_status                   = (int)$model->deed_status + 1;
        $property->receiver1_id                  = $model->receiver1_id;
        $property->receiver2_id                  = $model->receiver2_id;
        $property->indicator1                    = $model->indicator1;
        $property->indicator2                    = $model->indicator2;
        $property->area_width                    = str_replace(',', '.', $model->area_width);
        $property->area_height                   = str_replace(',', '.', $model->area_height);
        $property->total_area                    = str_replace(',', '.', $model->total_area);
        $property->total_built_area              = str_replace(',', '.', $model->total_built_area);
        $property->built_area_price              = str_replace(',', '.', $model->built_area_price);
        $property->total_area_price              = str_replace(',', '.', $model->total_area_price);
        $property->relative_distance             = $model->relative_distance;
        $property->orientation                   = $model->position != '' ? $model->position + 1 : null;
        $property->website_home_highlight        = (bool)$model->website_home_highlight;
        $property->website_rotative_banner       = (bool)$model->website_rotative_banner;
        $property->website_notes                 = $model->website_notes;
        $property->website_title                 = $model->website_title;
        $property->website_keywords              = $model->website_keywords;
        $property->website_description           = $model->website_description;
        $property->notes                         = $model->notes;
        $property->user_id                       = 1;
        $property->branch_id                     = (int)$model->branch_id;
        $property->website_showcase              = (bool)$model->website_alternative_highlight;
        $property->registry                      = $model->registry;

        $property->habitese = false;
        if(isset($model->habitese)) {
            $property->habitese = (bool)$model->habitese;
        }

        $property->levels                        = $model->pavement;
        $property->owners                        = [(int)$model->owner_id];
        $property->contacts                      = $model->contacts;
        $property->work_fund                     = $model->work_fund;
        $property->reserve_fund                  = $model->reserve_fund;
        $property->highlight_photo               = $model->highlight_photo;

        if ($model->type == 5) {
            $property->incra_number = $model->iptu_number;
            $property->incra_price  = str_replace(',', '.', $model->iptu_price);
            unset($property->iptu_price);
            unset($property->iptu_number);
            unset($property->relative_distance);
        }

        //se tiver contrato de autorizacao (0 no desktop) aí eh true no online
        $property->sales_authorization      = $model->sales_authorization == 0 ? true : false;
        $property->selling_exclusivity      = $model->sales_authorization == 1 ? true : false;
        $property->authorization_start_date = $this->formatDate($model->authorization_start_date);
        $property->authorization_end_date   = date('Y-m-d', strtotime("+ ". $model->authorization_end_date ." days", strtotime($property->authorization_start_date)));
        $property->lease_price              = $model->lease_price;

        if ($model->type == 2) {
            $property->ground_type = ($model->definition_02 != "") ? $model->definition_02 + 1 : '';
            $property->allotment = $model->allotment;
            $property->address_block = $model->address_block;
        }

        $property->opportunity        = (bool)$model->opportunity;
        $roomsCount                   = new \stdClass();
        $roomsCount->dorm             = (int)$model->bedrooms;
        $roomsCount->suit             = (int)$model->suits;
        $roomsCount->bathroom         = (int)$model->bathrooms;
        $roomsCount->room             = (int)$model->rooms;
        $roomsCount->kitchen          = (int)$model->kitchens;
        $roomsCount->parking_lot      = (int)$model->parking_spaces;
        $roomsCount->housekeeper_room = (int)$model->dependence_maid;
        $roomsCount->lavatory         = (int)$model->lavatory;
        $roomsCount->car_garage       = (int)$model->parking_lots;
        $property->roomsCount         = $roomsCount;
        $property->videos             = !empty($model->video_url) ? [$model->video_url] : [];

        $allFeatures                  = $typeInstance->getFeatures($model);

        if (isset($allFeatures->rooms['others'])) {
            $tmp = json_decode($property->migration_obs, true);
            $tmp['others'] = $allFeatures->rooms['others'];
            $property->migration_obs = $tmp;
            unset($allFeatures->rooms['others']);
        }

        if ($model->furnished) {
            $allFeatures->addFeature(126);
        }

        if ($model->release) {
            $allFeatures->addFeature(307);
        }

        if ($model->resale) {
            $allFeatures->addFeature(309);
        }

        if (isset($types['feature'])) {
            $allFeatures->addFeatures($types['feature']);
        }

        if ($model->type == 4) {

            if ($model->energy_type == 0) {
                $allFeatures->addFeature(194);
            }

            if ($model->energy_type == 1) {
                $allFeatures->addFeature(195);
            }

            if ($model->energy_type == 2) {
                $allFeatures->addFeature(196);
            }

        }

        $property->proximities        = $allFeatures->proximities;
        $property->features           = $allFeatures->features;
        $property->roomFeatures       = (object)$allFeatures->rooms;

        $property->created_at         = $this->formatDate($model->created_at);
        $property->updated_at         = $this->formatDate($model->updated_at);
        $property->deleted_at         = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;
        $property->publish            = $model->publish;
        $property->portals            = $model->portals;

        /*var_dump($property->features);
        echo '02: ' . $model->definition_02 .PHP_EOL.
            '03: ' . $model->definition_03.PHP_EOL.
            '04: ' . $model->definition_04.PHP_EOL.
            '05: ' . $model->definition_05.PHP_EOL.
            'master: ' . $model->definition_master.PHP_EOL.
            'code: ' . $model->code . PHP_EOL.
            'type: ' . $model->type . PHP_EOL;*/

        if(isset($model->vacations)){
            $property->vacations = $this->parseVacations($model->vacations);
        }

        $encodedProperty = new Property();

        foreach ($property as $key => $value) {

            $encodedProperty->{$key} = $value !== '' ? $value : null;

            if (!empty($value) && is_string($value)) {
                $encodedProperty->{$key} = utf8_encode(utf8_decode($value));
            }

        }

        return $encodedProperty;
    }

    private function getFinality($model)
    {
        switch ($model->type) {
            case 0: //casa
            case 1: //apartamento
                return 1; //residencial
                break;
            case 2: //terreno
                switch ($model->definition_01){ //valor do campo
                    case 0:
                    case 1:
                    case 5:
                    case 7:
                    case 8:
                    case 12:
                        return 1; //residencial
                        break;
                    case 2;
                    case 3;
                    case 4;
                        return 4; // rural
                        break;
                    case 6:
                    case 15:
                        return 3; // industrial
                        break;
                    case 9:
                    case 10:
                    case 11:
                    case 13:
                    case 14:
                        return 2; // comercial
                        break;
                }
                break;
            case 4: // imóvel comercial
                return 2; // comercial
                break;
            case 5: // imóvel rural
                return 4; // rural
                break;
        }
    }

    private function getInstanceByType($model)
    {
        switch ($model->type) {
            case 0:
                $instance = new House();
                break;
            case 1:
                $instance = new Apartment();
                break;
            case 2:
                $instance = new Land();
                break;
            case 4:
                $instance = new Commercial();
                break;
            case 5:
                $instance = new Rural();
                break;
        }

        return $instance;
    }

    private function getMeasureInfo($model)
    {
        $unit = 1;

        if($model->type == 5) {
            if ($model->area_width) {
               $unit = 1;
            } elseif($model->area_height) {
               $unit = 7;
            } elseif($model->total_area) {
               $unit = 2;
            }
        }

        return $unit;
    }

    public function getFlag($model)
    {
        if (!isset($this->flag[$model->flag])) {
            return $this->flag[8];
        }

        return $this->flag[$model->flag];
    }

}