<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 05/07/16
     * Time: 11:41
     */
    class  HouseTest extends PHPUnit_Framework_TestCase
    {


        /** @test */
        public function it_must_return_house_isolada()
        {
            $house = $this->getHouse('1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::ISOLADA, $house->subtype);
        }


        /** @test */
        public function it_must_return_house_geminada()
        {
            $house = $this->getHouse('01');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::GEMINADA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_sobrado()
        {
            $house = $this->getHouse(str_repeat('0', 2) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::SOBRADO, $house->subtype);
        }


        /** @test */
        public function it_must_return_house_esquina()
        {
            $house = $this->getHouse(str_repeat('0', 3) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::ESQUINA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_padrao()
        {
            $house = $this->getHouse(str_repeat('0', 4) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::PADRAO, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_vila()
        {
            $house = $this->getHouse(str_repeat('0', 5) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::VILA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_condominio_fechado()
        {
            $house = $this->getHouse(str_repeat('0', 6) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::CONDOMINIO_FECHADO,
                $house->subtype);
        }

        /** @test */
        public function it_must_return_house_condominio_sobreposta_alta()
        {
            $house = $this->getHouse(str_repeat('0', 7) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::SOBREPOSTA_ALTA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_condominio_sobreposta_baixa()
        {
            $house = $this->getHouse(str_repeat('0', 8) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::SOBREPOSTA_BAIXA, $house->subtype);
        }


        /** @test */
        public function it_must_return_house_semi_acabada()
        {
            $house = $this->getHouse(str_repeat('0', 9) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::SEMI_ACABADA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_edicula()
        {
            $house = $this->getHouse(str_repeat('0', 10) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::EDICULA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_alto_padrao()
        {
            $house = $this->getHouse(str_repeat('0', 11) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::ALTO_PADRAO, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_casa_terrea()
        {
            $house = $this->getHouse(str_repeat('0', 11) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::ALTO_PADRAO, $house->subtype);
        }


        /** @test */
        public function it_must_return_house_loteamento_fechado()
        {
            $house = $this->getHouse(str_repeat('0', 13) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::LOTEAMENTO_FECHADO,
                $house->subtype);
        }

        /** @test */
        public function it_must_return_house_loteamento_kitchnete()
        {
            $house = $this->getHouse(str_repeat('0', 14) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::KITCHNETEE, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_reformada()
        {
            $house = $this->getHouse(str_repeat('0', 15) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::REFORMADA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_casa_renda()
        {
            $house = $this->getHouse(str_repeat('0', 19) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::CASA_RENDA, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_vilagio()
        {
            $house = $this->getHouse(str_repeat('0', 20) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::VILAGIO, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_duplex()
        {
            $house = $this->getHouse(str_repeat('0', 21) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::DUPLEX, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_triplex()
        {
            $house = $this->getHouse(str_repeat('0', 22) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::TRIPLEX, $house->subtype);
        }

        /** @test */
        public function it_must_return_house_frente_mar()
        {
            $house = $this->getHouse(str_repeat('0', 23) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::FRENTE_MAR, $house->subtype);
        }


        /** @test */
        public function it_must_return_house_assobradado()
        {
            $house = $this->getHouse(str_repeat('0', 24) . '1');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\House::ASSOBRADADO, $house->subtype);
        }


        /** @test */
        public function it_must_have_all_characteristics()
        {
            $stringao = str_repeat('1', 239);
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(34, $apartament->characteristics['bedroom']);
            $this->assertCount(34, $apartament->characteristics['room']);
            $this->assertCount(34, $apartament->characteristics['kitchen']);
            $this->assertCount(34, $apartament->characteristics['bathroom']);
            $this->assertCount(34, $apartament->characteristics['service_area']);
            $this->assertCount(34, $apartament->characteristics['front']);
            $this->assertCount(31, $apartament->characteristics['more_itens']);


        }


        /** @test */
        public function it_must_have_all_characteristics_of_bedroom()
        {
            $stringao = str_repeat('0', (34 * 0) ) . str_repeat('1', 34) . str_repeat('0', 238-(34 * 1));
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(34, $apartament->characteristics['bedroom']);
            $this->assertCount(0, $apartament->characteristics['room']);
            $this->assertCount(0, $apartament->characteristics['kitchen']);
            $this->assertCount(0, $apartament->characteristics['bathroom']);
            $this->assertCount(0, $apartament->characteristics['service_area']);
            $this->assertCount(0, $apartament->characteristics['front']);
            $this->assertCount(0, $apartament->characteristics['more_itens']);
        }

        /** @test */
        public function it_must_have_all_characteristics_of_room()
        {

            $stringao = str_repeat('0', (34 * 1) ) . str_repeat('1', 34) . str_repeat('0', 238-(34 * 2));
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(0, $apartament->characteristics['bedroom']);
            $this->assertCount(34, $apartament->characteristics['room']);
            $this->assertCount(0, $apartament->characteristics['kitchen']);
            $this->assertCount(0, $apartament->characteristics['bathroom']);
            $this->assertCount(0, $apartament->characteristics['service_area']);
            $this->assertCount(0, $apartament->characteristics['front']);
            $this->assertCount(0, $apartament->characteristics['more_itens']);
        }

        /** @test */
        public function it_must_have_all_characteristics_of_kitchen()
        {
            $stringao = str_repeat('0', (34 * 2) ) . str_repeat('1', 34) . str_repeat('0', 238-(34 * 3));
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(0, $apartament->characteristics['bedroom']);
            $this->assertCount(0, $apartament->characteristics['room']);
            $this->assertCount(34, $apartament->characteristics['kitchen']);
            $this->assertCount(0, $apartament->characteristics['bathroom']);
            $this->assertCount(0, $apartament->characteristics['service_area']);
            $this->assertCount(0, $apartament->characteristics['front']);
            $this->assertCount(0, $apartament->characteristics['more_itens']);
        }

        /** @test */
        public function it_must_have_all_characteristics_of_bathroom()
        {
            $stringao = str_repeat('0', (34 * 3) ) . str_repeat('1', 34) . str_repeat('0', 238-(34 * 4));
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(0, $apartament->characteristics['bedroom']);
            $this->assertCount(0, $apartament->characteristics['room']);
            $this->assertCount(0, $apartament->characteristics['kitchen']);
            $this->assertCount(34, $apartament->characteristics['bathroom']);
            $this->assertCount(0, $apartament->characteristics['service_area']);
            $this->assertCount(0, $apartament->characteristics['front']);
            $this->assertCount(0, $apartament->characteristics['more_itens']);
        }


        /** @test */
        public function it_must_have_all_characteristics_of_service_area()
        {
            $stringao = str_repeat('0', (34 * 4) ) . str_repeat('1', 34) . str_repeat('0', 238-(34 * 5));
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(0, $apartament->characteristics['bedroom']);
            $this->assertCount(0, $apartament->characteristics['room']);
            $this->assertCount(0, $apartament->characteristics['kitchen']);
            $this->assertCount(0, $apartament->characteristics['bathroom']);
            $this->assertCount(34, $apartament->characteristics['service_area']);
            $this->assertCount(0, $apartament->characteristics['front']);
            $this->assertCount(0, $apartament->characteristics['more_itens']);
        }

        /** @test */
        public function it_must_have_all_characteristics_of_front()
        {
            $stringao = str_repeat('0', (34 * 5) ) . str_repeat('1', 34) . str_repeat('0', 238-(34 * 6));
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(0, $apartament->characteristics['bedroom']);
            $this->assertCount(0, $apartament->characteristics['room']);
            $this->assertCount(0, $apartament->characteristics['kitchen']);
            $this->assertCount(0, $apartament->characteristics['bathroom']);
            $this->assertCount(0, $apartament->characteristics['service_area']);
            $this->assertCount(34, $apartament->characteristics['front']);
            $this->assertCount(0, $apartament->characteristics['more_itens']);
        }

        /** @test */
        public function it_must_have_all_characteristics_of_more_itens()
        {
            $stringao = str_repeat('0', (34 * 6) ) . str_repeat('1', 34) . str_repeat('0', 238-(34 * 7));
            $apartament = $this->getHouse('1', $stringao);

            $this->assertCount(0, $apartament->characteristics['bedroom']);
            $this->assertCount(0, $apartament->characteristics['room']);
            $this->assertCount(0, $apartament->characteristics['kitchen']);
            $this->assertCount(0, $apartament->characteristics['bathroom']);
            $this->assertCount(0, $apartament->characteristics['service_area']);
            $this->assertCount(0, $apartament->characteristics['front']);
            $this->assertCount(31, $apartament->characteristics['more_itens']);
        }


        /** @test */
        public function it_must_get_all_external_area_options()
        {
            $house = $this->getHouse('1', '1', str_repeat('1', 59));

            $this->assertCount(59, $house->characteristics['external_area']);
            $this->assertEquals('lavanderia_coletiva', $house->characteristics['external_area'][58]);

        }

        /** @test */
        public function it_must_detect_the_correct_room_numbers()
        {
            $house = $this->getHouse();

            $this->assertEquals(4, $house->bedroom);
            $this->assertEquals(2, $house->suite);
            $this->assertEquals(3, $house->bathroom);
            $this->assertEquals(1, $house->room);
            $this->assertEquals(5, $house->kitchen);
            $this->assertEquals(6, $house->garage_lot);
            $this->assertEquals(9, $house->housekeeper_room);
            $this->assertEquals(7, $house->lavatory);

        }


        public function getHouse($definicao = '1', $definicaoMaster = '1', $definicao02 = '1')
        {
            $std = new stdClass();


            $std->definicao_01 = $definicao;
            $std->definicao_02 = $definicao02;
            $std->definicao_master = $definicaoMaster;

            $std->dorms = 4;
            $std->suites = 2;
            $std->banheiros = 3;
            $std->salas = 1;
            $std->cozinhas = 5;
            $std->vagas_garagem = 6;
            $std->area_servico = 8;
            $std->dep_empregada = 9;
            $std->lavabos = 7;

            return new \Microsistec\DbParser\Definition\PropertyType\House($std);

        }

    }