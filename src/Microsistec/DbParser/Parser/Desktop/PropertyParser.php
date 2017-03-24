<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 3/13/17
 * Time: 6:02 PM
 */

namespace Microsistec\DbParser\Parser\Desktop;


use Microsistec\DbParser\Definition\PropertyType\Apartament;
use Microsistec\DbParser\Definition\PropertyType\Commercial;
use Microsistec\DbParser\Definition\PropertyType\House;
use Microsistec\DbParser\Definition\PropertyType\Rural;
use Microsistec\DbParser\Definition\PropertyType\Terrain;
use Microsistec\DbParser\Parser\OldParser;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class PropertyParser extends OldParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $property = new Property();

        $property->maintence_id = $model->id;
        $property->id = $model->id;
        $property->code = $model->code;
        $property->alternative_code = $model->alternative_code;
        $property->user_code = $model->code;
        $property->old_type = $model->type;

        $property->finality = '';
        $property->type = '';
        $property->subtype = '';

        $property->for_rent = substr($model->finality, 0, 1);
        $property->for_sale = substr($model->finality, 1, 1);
        $property->for_vacation = substr($model->finality, 2, 1);

        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        /*$property->situation = $model->situation + 1;
        $property->has_board = $model->has_board;*/

        $property->zipcode = $this->unMask($model->zipcode);
        $property->zone = $model->zone;
        $property->street = $model->street;

        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        //$property->block = $model->block;

        $property->street_number = $model->street_number;
        $property->complementary = $model->complementary;
        $property->condominium_name = $model->condominium_name;
        $property->age = $model->age;
        $property->floor = $model->floor;
        $property->reference_point = $model->reference_point;
        $property->sell_price = $model->sell_price;
        $property->monthly_installments = $model->monthly_qtd;
        $property->monthly_installments_value = $model->monthly_value;
        $property->quarterly_installments = $model->quartely_qtd;
        $property->quarterly_installments_value = $model->quartely_value;
        $property->semiannual_installments = $model->semiannual_qtd;
        $property->semiannual_installments_value = $model->semiannual_value;
        $property->annual_installments = $model->annual_qtd;
        $property->annual_installments_value = $model->annual_value;
        $property->keys_installments = $model->keys_qtd;
        $property->keys_installments_value = $model->keys_value;
        $property->rent_price = $model->rent_price;
        $property->iptu_price = $model->iptu_price;
        $property->condominium_price = $model->condominium_price;
        $property->fgts = substr($model->payment_options, 0,1);
        $property->letter_of_credit = substr($model->payment_options, 1,1);
        $property->bank_financing = substr($model->payment_options, 13,1);
        $property->direct_financing = substr($model->payment_options, 12,1);
        $property->lessor_bail = substr($model->payment_options, 4,1);
        $property->guarantor = substr($model->payment_options, 5,1);
        $property->deposit = substr($model->payment_options, 6,1);
        $property->mcmv = $model->mcmv;
        $property->requires_guarantor_deed = substr($model->payment_options, 7,1);

        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        //$property->keys = $model->keys;

        //$property->keys_available = ($model->keys != '') ? true : false;
        $property->mcmv = $model->mcmv;

        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        /*$property->iptu_number = $model->iptu_number;
        $property->energy_number = $model->energy_number;
        $property->water_number = $model->water_number;
        $property->registration_number = $model->registration_number;
        $property->deed_status = $model->deed_status;*/

        $property->receiver1_id = $model->receiver1_id;
        $property->receiver2_id = $model->receiver2_id;
        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        /*$property->indicator1 = $model->indicator1;
        $property->indicator2 = $model->indicator2;*/

        $property->area_width = $model->area_width;
        $property->area_height = $model->area_height;
        $property->total_area = $model->total_area;
        $property->total_built_area = $model->total_built_area;
        $property->built_area_price = $model->built_area_price;
        $property->total_area_price = $model->total_area_price;
        $property->relative_distance = $model->relative_distance;
        $property->orientation = $model->position + 1;
        $property->website_home_highlight = $model->website_home_highlight;
        $property->website_rotative_banner = $model->website_rotative_banner;
        $property->website_notes = $model->website_notes;
        $property->website_title = $model->website_title;
        $property->website_keywords = $model->website_keywords;
        $property->website_description = $model->website_description;

        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        //$property->notes = $model->notes;

        $property->user_id = 1;
        $property->branch_id = $model->branch_id;
        $property->website_showcase = $model->website_alternative_highlight;

        if($model->type == 5){
            $property->incra_number = $model->website_alternative_highlight;
            $property->incra_price = $model->iptu_price;
        }

        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        /*$property->sales_authorization = $model->sales_authorization;
        $property->authorization_start_date = $model->authorization_start_date;
        $property->authorization_end_date = $model->authorization_end_date;
        $property->lease_price = $model->lease_price;*/

        if($model->type == 2){
            $property->ground_type = $model->definition_02 + 1;
        }
        $property->opportunity = $model->opportunity;
        $roomsCount = new \stdClass();
        $roomsCount->dorm = $model->bedrooms;
        $roomsCount->suit = $model->suits;
        $roomsCount->bathroom = $model->bathrooms;
        $roomsCount->room = $model->rooms;
        $roomsCount->kitchen = $model->kitchens;
        $roomsCount->parking_lot = $model->parking_spaces;
        $roomsCount->housekeeper_room = $model->dependence_maid;
        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        //$roomsCount->lavatory = $model->lavatory;
        $roomsCount->car_garage = $model->parking_lots;
        $property->roomsCount = $roomsCount;
        $property->videos = [$model->video_url];

        /**
         * TODO: DESKTOP PRECISA MANDAR
         */
        //$property->vacations = $model->vacations;

        return $property;
    }


    public function getPropertyType($model)
    {
        switch ($model->type) {
            case '0':
                return new House($model);
            case '1':
                return new Apartament($model);
            case '2':
                return new Terrain($model);
            case '4':
                return new Commercial($model);
            case '5':
                return new Rural($model);
        }
    }


}