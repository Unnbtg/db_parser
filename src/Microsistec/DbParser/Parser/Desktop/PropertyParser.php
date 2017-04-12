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
        $property->for_rent                      = (bool)substr($model->finality, 0, 1);
        $property->for_sale                      = (bool)substr($model->finality, 1, 1);
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
        $property->advance_payment               = str_replace(',', '.', $model->advance_payment);
        $property->rent_price                    = str_replace(',', '.', $model->rent_price);
        $property->iptu_price                    = str_replace(',', '.', $model->iptu_price);
        $property->condominium_price             = str_replace(',', '.', $model->condominium_price);
        $property->migration_obs                 = $model->migration_obs;

        if($model->payment_options != ''){
            $property->fgts                          = (bool)substr($model->payment_options, 0, 1);
            $property->letter_of_credit              = (bool)substr($model->payment_options, 1, 1);
            $property->bank_financing                = (bool)substr($model->payment_options, 13, 1);
            $property->direct_financing              = (bool)substr($model->payment_options, 12, 1);
            $property->lessor_bail                   = (bool)substr($model->payment_options, 4, 1);
            $property->guarantor                     = (bool)substr($model->payment_options, 5, 1);
            $property->deposit                       = (bool)substr($model->payment_options, 6, 1);
            $property->requires_guarantor_deed       = (bool)substr($model->payment_options, 7, 1);
            $property->exchange                      = (bool)substr($model->payment_options, 8, 4);
        }

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
        $property->area_width                    = $model->area_width;
        $property->area_height                   = $model->area_height;
        $property->total_area                    = $model->total_area;
        $property->total_built_area              = $model->total_built_area;
        $property->built_area_price              = $model->built_area_price;
        $property->total_area_price              = $model->total_area_price;
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

        $property->levels                        = $model->pavement;
        $property->owner_id                      = (int)$model->owner_id;
        $property->contacts                      = $model->contacts;
        $property->work_fund                     = $model->work_fund;
        $property->reserve_fund                  = $model->reserve_fund;
        $property->highlight_photo               = $model->highlight_photo;


        if ($model->type == 5) {
            $property->incra_number = $model->iptu_number;
            $property->incra_price  = $model->iptu_price;
        }

        //se tiver contrato de autorizacao (0 no desktop) aí eh true no online
        $property->sales_authorization      = $model->sales_authorization == 0 ? true : false;
        $property->authorization_start_date = $this->formatDate($model->authorization_start_date);
        $property->authorization_end_date   = date('Y-m-d', strtotime("+ ". $model->authorization_end_date ." days", strtotime($property->authorization_start_date)));
        $property->lease_price              = $model->lease_price;

        if ($model->type == 2) {
            $property->ground_type = ($model->definition_02 != "") ? $model->definition_02 + 1 : '';
        }

        $property->opportunity        = (bool)$model->opportunity;
        $roomsCount                   = new \stdClass();
        $roomsCount->dorm             = $model->bedrooms;
        $roomsCount->suit             = $model->suits;
        $roomsCount->bathroom         = $model->bathrooms;
        $roomsCount->room             = $model->rooms;
        $roomsCount->kitchen          = $model->kitchens;
        $roomsCount->parking_lot      = $model->parking_spaces;
        $roomsCount->housekeeper_room = $model->dependence_maid;
        $roomsCount->lavatory         = $model->lavatory;
        $roomsCount->car_garage       = $model->parking_lots;
        $property->roomsCount         = $roomsCount;
        $property->videos             = !empty($model->video_url) ? [$model->video_url] : [];
        $property->features           = $typeInstance->getFeatures($model);

        if (isset($property->features->rooms['others'])) {
            $tmp = json_decode($property->migration_obs, true);
            $tmp['others'] = $property->features->rooms['others'];
            $property->migration_obs = $tmp;
        }

        if ($model->furnished) {
            $property->features->addFeature(126);
        }

        if ($model->release) {
            $property->features->addFeature(307);
        }

        if ($model->resale) {
            $property->features->addFeature(309);
        }

        if (isset($types['feature'])) {
            $property->features->addFeatures($types['feature']);
        }

        $property->created_at         = $this->formatDate($model->created_at);
        $property->updated_at         = $this->formatDate($model->updated_at);
        $property->deleted_at         = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;

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

            if (is_scalar($value)) {

                if(!is_int($value)) {
                    $encodedProperty->{$key} = utf8_encode(utf8_decode($value));
                }

                continue;
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

    public function getFlag($model)
    {
        return $this->flag[$model->flag];
    }

}