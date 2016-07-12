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

            $property->reference = $model->alternative_code;
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
            $property->number = $model->street_number;
            $property->cep = $model->zipcode;
            $property->state = $this->getState($model->state_id);
            $property->zone = $model->zone;
            $property->address = $model->street;
            $property->complement = $model->complementary;

            $property->age = $model->age;

            $property->characteristics = $this->getFeatures($model);



            return $property;

        }

        public function getFeatures($model)
        {
            $characteristics = [];
            foreach ($model->features as $feature) {
                $characteristics[] = $feature->name;
            }

            return $characteristics;
        }

        public function getState($id)
        {
            $states =  [
                1 => "Acre",
                "Alagoas",
                "Amapá",
                "Amazonas",
                'Bahia',
                'Ceará',
                "Distrito Federal",
                'Espirito Santo',
                'Goiás',
                'Maranhão',
                "Mato Grosso",
                'Mato Grosso do Sul',
                'Minas Gerais',
                'Pará',
                'Paraíba',
                'Paraná',
                'Pernambuco',
                'Piauí',
                'Rio de Janeiro',
                'Rio Grande do Norte',
                'Rondônia',
                'Roraima',
                'Santa Catarina',
                'São Paulo',
                'Sergipe',
                'Tocantins',
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


    }