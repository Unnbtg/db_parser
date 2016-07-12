<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 11/07/16
     * Time: 15:40
     */
    class NewParserTest extends PHPUnit_Framework_TestCase
    {
        /**
         * @var \Microsistec\DbParser\Models\Property
         */
        protected $property;

        public function setUp()
        {
            $capsule = new Illuminate\Database\Capsule\Manager();

            $capsule->addConnection([
                                        'driver'   => 'sqlite',
                                        'database' => __DIR__ . '/database.sqlite',
                                    ]);
            $capsule->bootEloquent();
            $this->property = \Microsistec\DbParser\Models\Property::first();
        }


        /** @test */


        /** @test */
        public function it_must_have_all_prices()
        {
            $property = $this->getProperty();

            $p = $property->toProperty();

            $this->assertCount(3, $p->disponibility);

            $this->assertInstanceOf(\Microsistec\DbParser\Definition\Disponibility\Sell::class, $p->disponibility[0]);
            $this->assertInstanceOf(\Microsistec\DbParser\Definition\Disponibility\Rent::class, $p->disponibility[1]);
            $this->assertInstanceOf(\Microsistec\DbParser\Definition\Disponibility\Season::class, $p->disponibility[2]);

        }

        /** @test */
        public function it_must_have_the_correct_set_of_rooms()
        {
            $tempProperty = $this->getProperty();

            $property = $tempProperty->toProperty();

            $this->assertEquals(2, $property->bedroom);
            $this->assertEquals(3, $property->bathroom);
            $this->assertEquals(1, $property->room);
            $this->assertEquals(4, $property->housekeeper_room);
            $this->assertEquals(3, $property->kitchen);
            $this->assertEquals(2, $property->lavatory);
            $this->assertEquals(2, $property->suites);
            $this->assertEquals(5, $property->parking_lot);
            $this->assertEquals(4, $property->garage_lot);
        }


        /** @test */
        public function it_must_have_features()
        {
            $tempProperty = $this->getProperty();

            $property = $tempProperty->toProperty();

            $this->assertCount(5, $property->characteristics);

            $this->assertEquals('Abacate', $property->characteristics[0]);
            $this->assertEquals('Sacola', $property->characteristics[1]);
            $this->assertEquals('Abobrinha', $property->characteristics[2]);
            $this->assertEquals('Beterraba', $property->characteristics[3]);
            $this->assertEquals('Reformado', $property->characteristics[4]);
        }

        /** @test */
        public function it_must_have_an_address()
        {
            $tempProperty = $this->getProperty();

            $property = $tempProperty->toProperty();

            $this->assertEquals("Abacate", $property->city);
            $this->assertEquals("Teste Loko", $property->neighborhood);
            $this->assertEquals(150, $property->number);
            $this->assertEquals('11750-000', $property->cep);
            $this->assertEquals("Acre", $property->state);
            $this->assertEquals("Zona 3", $property->zone);
            $this->assertEquals("Alameda 24", $property->address);
            $this->assertEquals("Ap 80", $property->complement);

        }

        public function getProperty()
        {
            $property = new \Microsistec\DbParser\Models\Property();

            $vacation = new \Microsistec\DbParser\Models\PropertyVacation();
            $vacation->type = 2;
            $vacation->name = "diaária";
            $vacation->price = 50;


            $property->for_rent = true;
            $property->for_sale = true;
            $property->for_vacation = true;


            $property->vacations[] = $vacation;
            $property->sell_price = 1500000;
            $property->rent_price = 1500;

            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::BEDROOM);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::BEDROOM);


            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::BATHROOM);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::BATHROOM);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::BATHROOM);

            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::ROOM);

            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::HOUSEKEEPER_ROOM);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::HOUSEKEEPER_ROOM);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::HOUSEKEEPER_ROOM);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::HOUSEKEEPER_ROOM);

            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::KITCHEN);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::KITCHEN);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::KITCHEN);

            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::LAVATORY);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::LAVATORY);


            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::SUITE);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::SUITE);


            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKINGLOT);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKINGLOT);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKINGLOT);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKINGLOT);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKINGLOT);


            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKING_GARAGE);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKING_GARAGE);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKING_GARAGE);
            $property->rooms[] = $this->createRoom(\Microsistec\DbParser\Parser\SciOnline\RoomParser::PARKING_GARAGE);


            $property->features[] = $this->createFeature("Abacate");
            $property->features[] = $this->createFeature("Sacola");
            $property->features[] = $this->createFeature("Abobrinha");
            $property->features[] = $this->createFeature("Beterraba");
            $property->features[] = $this->createFeature("Reformado");

            $city = new \Microsistec\DbParser\Models\City();
            $city->name = "Abacate";

            $neighborhood = new \Microsistec\DbParser\Models\Neighborhood;
            $neighborhood->name = "Teste Loko";

            $property->city = $city;
            $property->neighborhood = $neighborhood;
            $property->street_number = 150;
            $property->zipcode = '11750-000';
            $property->state_id = 1;
            $property->zone = 'Zona 3';
            $property->street = "Alameda 24";
            $property->complementary = "Ap 80";

            return $property;
        }


        protected function createFeature($name)
        {
            $feature = new \Microsistec\DbParser\Models\Feature;
            $feature->name = $name;
            return $feature;
        }

        protected function createRoom($type)
        {
            $room = new \Microsistec\DbParser\Models\PropertyRoom();

            $room->type = $type;

            return $room;
        }



    }