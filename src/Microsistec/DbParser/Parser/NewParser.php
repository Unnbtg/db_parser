<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 08/07/16
 * Time: 17:46
 */

namespace Microsistec\DbParser\Parser;


use Microsistec\DbParser\Definition\Disponibility\Rent;
use Microsistec\DbParser\Definition\Disponibility\Season;
use Microsistec\DbParser\Definition\Disponibility\Sell;
use Microsistec\DbParser\Parser\SciOnline\RentParser;
use Microsistec\DbParser\Parser\SciOnline\RoomParser;
use Microsistec\DbParser\Parser\SciOnline\SeasonParser;
use Microsistec\DbParser\Parser\SciOnline\SellParser;
use Microsistec\DbParser\Property;

class NewParser extends ParserAbstract
{
    public function parse($model, $domain = "", $account = "")
    {
        $property = new Property();

        $property->id = $model->id;
        $property->alternative_code = $model->alternative_code;
        $property->reference = $model->code;
        $property->disponibility = $this->getDisponibility($model);
        $rooms = $this->getRooms($model);
        $property->bathroom = $rooms[RoomParser::BATHROOM];
        $property->suites = $rooms[RoomParser::SUITE];
        $property->bedroom = $rooms[RoomParser::BEDROOM];
        $property->lavatory = $rooms[RoomParser::LAVATORY];
        $property->housekeeper_room = $rooms[RoomParser::HOUSEKEEPER_ROOM];
        $property->parking_lot = $rooms[RoomParser::PARKINGLOT];
        $property->garage_lot = $rooms[RoomParser::PARKING_GARAGE];
        $property->room = $rooms[RoomParser::ROOM];
        $property->kitchen = $rooms[RoomParser::KITCHEN];
        $property->city = $model->city->name;
        $property->neighborhood = $model->neighborhood->name;
        $property->alternative_neighborhood = !is_null($model->alternative_neighborhood) ? $model->alternative_neighborhood->name : $model->neighborhood->name;
        $property->number = $model->street_number;
        $property->reference_point = $model->reference_point;
        $property->cep = $model->zipcode;
        $property->state = $this->getState($model->state_id);
        $property->zone = $model->zone;
        $property->address = $model->street;
        $property->complement = $model->complementary;
        $property->age = $model->age;
        $property->construction_age = $this->getAge($model->age);
        $property->characteristics = $this->getFeatures($model->features);
        $property->condominium_price = $model->condominium_price;
        $property->condominium_name = $model->condominium_name;
        $property->iptu_price = $model->iptu_price;
        $property->vacation_max = $model->vacation_max;
        $property->vacation_parkingLots = $model->vacation_parkingLots;
        $property->type = $model->type;
        $property->subtype = $model->subtype;
        $property->video_url = $this->getVideosUrl($model->videos);
        $property->sell_price = $model->sell_price;
        $property->rent_price = $model->rent_price;
        $property->total_area = $model->total_area;
        $property->web_obs = $model->website_notes;
        $property->photos = $this->getPicture($model->photos);
        $property->obs = $model->notes;
        $property->condominium_price = $model->condominium_price;
        $property->build_name = $model->condominium_name;
        $property->latitude = $model->latitude;
        $property->longitude = $model->longitude;
        $property->website_title = $model->website_title;
        $property->useful_area = $model->total_built_area;
        $property->for_sale = $model->for_sale;
        $property->for_rent = $model->for_rent;
        $property->for_vacation = $model->for_vacation;
        $property->for_vacation = $model->for_vacation;
        $property->created_at = $model->created_at;
        $property->updated_at = $model->updated_at;
        $property->finality_info = $model->finality_info;
        $property->situation_info = $model->situation_info;
        $property->orientation_info = $model->orientation_info;
        $property->seller_contact = $this->getContact($model->user);
        $property->measure_unit_info = $model->measure_unit_info;
        $property->selling_exclusivity = $model->selling_exclusivity;
        $property->website_notes = $model->website_notes;

        return $property;

    }

    public function getContact($model)
    {
        $owner = [
            'name' => $model->name,
            'email' => $model->email,
        ];
        return $owner;
    }

    public function getPicture($model)
    {
        foreach($model as $photos){
            $pictures[] = $photos;
        }
        return $pictures;
    }

    public function getFeatures($model)
    {
        $characteristics = [];
        foreach ($model as $feature) {
            $characteristics[] = $feature->name;
        }
        return $characteristics;
    }

    public function getVideosUrl($model)
    {
        foreach($model as $video){
            return $video->url;
        }
    }
    public function getState($id)
    {
        $states = [
            1 => "AC",
            "AL",
            "AP",
            "AM",
            'BA',
            'CE',
            "DF",
            'ES',
            'GO',
            'MA',
            "MT",
            'MS',
            'MG',
            'PA',
            'PB',
            'PR',
            'PE',
            'PI',
            'RJ',
            'RN',
            'RS',
            'RO',
            'RR',
            'SC',
            'SP',
            'SE',
            'TO',
        ];

        return $states[$id];
    }

    protected function getDisponibility($model)
    {

        $disponibility = [];

        if ($model->for_sale) {
            $disponibility[] = $this->createSaleObject($model);
        }

        if ($model->for_rent) {
            $disponibility[] = $this->createRentObject($model);
        }

        if ($model->for_vacation) {
            $disponibility[] = $this->createSeasonObject($model);
        }

        return $disponibility;
    }

    public function createSaleObject($model)
    {
        $parser = new SellParser;

        return $parser->parse($model);
    }


    public function createRentObject($model)
    {
        $parser = new RentParser;

        return $parser->parse($model);
    }


    public function createSeasonObject($model)
    {
        $parser = new SeasonParser();

        return $parser->parse($model);
    }

    public function getRooms($model)
    {
        $parser = new RoomParser();

        return $parser->parse($model);
    }

    public function getAge($age)
    {
        $current = date("Y");
        $year = $current - $age;
        return $year;
    }
}