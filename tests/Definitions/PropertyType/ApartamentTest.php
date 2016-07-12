<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 04/07/16
     * Time: 15:42
     */
    class ApartamentTest extends PHPUnit_Framework_TestCase
    {


        /** @test */
        public function it_must_detect_as_a_padrao()
        {
            $apartament = $this->getApartament('1111111111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::PADRAO, $apartament->subtype);
        }


        /** @test */
        public function it_must_detect_as_a_kitchnet()
        {
            $apartament = $this->getApartament('0111111111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::KITCHINETE,
                $apartament->subtype);
        }


        /** @test */
        public function it_must_detect_as_a_cobertura()
        {
            $apartament = $this->getApartament('0011111111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::COBERTURA,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_duplex()
        {
            $apartament = $this->getApartament('0001111111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::DUPLEX, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_triplex()
        {
            $apartament = $this->getApartament('0000111111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::TRIPLEX,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_alto_padrao()
        {
            $apartament = $this->getApartament('0000011111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::ALTO_PADRAO,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_um_por_andar()
        {
            $apartament = $this->getApartament('0000001111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::UM_POR_ANDAR,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_flat()
        {
            $apartament = $this->getApartament('0000000111111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::FLAT, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_sala_living()
        {
            $apartament = $this->getApartament('0000000011111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::SALA_LIVING,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_medio()
        {
            $apartament = $this->getApartament('0000000001111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::MEDIO, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_grande()
        {
            $apartament = $this->getApartament('0000000000111110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::GRANDE, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_terreo()
        {
            $apartament = $this->getApartament('0000000000011110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::TERREO, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_loft()
        {
            $apartament = $this->getApartament('0000000000001110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::LOFT, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_vista_mar()
        {
            $apartament = $this->getApartament('0000000000000110011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::VISTA_MAR,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_reformado()
        {
            $apartament = $this->getApartament('0000000000000010011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::REFORMADO,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_sem_condominio()
        {
            $apartament = $this->getApartament('0000000000000000011111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::SEM_CONDOMINIO,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_frente_mar()
        {
            $apartament = $this->getApartament('0000000000000000001111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::FRENTE_MAR,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_studio()
        {
            $apartament = $this->getApartament('0000000000000000000111100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::STUDIO, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_tipo_casa()
        {
            $apartament = $this->getApartament('0000000000000000000011100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::TIPO_CASA,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_campo()
        {
            $apartament = $this->getApartament('0000000000000000000001100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::CAMPO, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_penthouse()
        {
            $apartament = $this->getApartament('0000000000000000000000100000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::PENTHOUSE,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_garden()
        {
            $apartament = $this->getApartament('0000000000000000000000010000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::GARDEN, $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_gerden_elevado()
        {
            $apartament = $this->getApartament('0000000000000000000000001000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::GARDEN_ELEVADO,
                $apartament->subtype);
        }

        /** @test */
        public function it_must_detect_as_a_sem_subtipo()
        {
            $apartament = $this->getApartament('0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Apartament::SEM_SUBTIPO,
                $apartament->subtype);
        }


        /** @test */
        public function it_must_have_all_characteristics()
        {
            $stringao = str_repeat('1', 238);
            $apartament = $this->getApartament('1', $stringao);

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
            $stringao = '1111111111111111111111111111111111000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000';
            $apartament = $this->getApartament('1', $stringao);

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
            $stringao = '0000000000000000000000000000000000111111111111111111111111111111111100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000';
            $apartament = $this->getApartament('1', $stringao);

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
            $stringao = '0000000000000000000000000000000000000000000000000000000000000000000011111111111111111111111111111111110000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000';
            $apartament = $this->getApartament('1', $stringao);

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
            $stringao = '0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001111111111111111111111111111111111000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000';
            $apartament = $this->getApartament('1', $stringao);

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
            $stringao = '0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000111111111111111111111111111111111100000000000000000000000000000000000000000000000000000000000';
            $apartament = $this->getApartament('1', $stringao);

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
            $stringao = '0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000011111111111111111111111111111111110000000000000000000000000';
            $apartament = $this->getApartament('1', $stringao);

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
            $stringao = '0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000001111111111111111111111111111111111';
            $apartament = $this->getApartament('1', $stringao);

            $this->assertCount(0, $apartament->characteristics['bedroom']);
            $this->assertCount(0, $apartament->characteristics['room']);
            $this->assertCount(0, $apartament->characteristics['kitchen']);
            $this->assertCount(0, $apartament->characteristics['bathroom']);
            $this->assertCount(0, $apartament->characteristics['service_area']);
            $this->assertCount(0, $apartament->characteristics['front']);
            $this->assertCount(31, $apartament->characteristics['more_itens']);
        }

        /** @test */
        public function it_must_have_all_leisure_options()
        {
            $stringao = str_repeat('1', 20);
            $apartament = $this->getApartament('1', '1', $stringao);

            $this->assertCount(20, $apartament->characteristics['leisure']);
            $this->assertEquals('jacuzzi', $apartament->characteristics['leisure'][19]);
        }


        /** @test */
        public function it_must_have_all_external_options()
        {
            $stringao = str_repeat('1', 33);
            $apartament = $this->getApartament('1', '1', '1', $stringao);

            $this->assertCount(33, $apartament->characteristics['external_area']);
            $this->assertEquals('sacada_tecnica', $apartament->characteristics['external_area'][32]);
        }


        /** @test */
        public function it_must_have_all_security_options()
        {
            $stringao = str_repeat('1', 9);
            $apartament = $this->getApartament('1', '1', '1', '1', $stringao);

            $this->assertCount(8, $apartament->characteristics['security']);
            $this->assertEquals('vaga_anti-sequestro', $apartament->characteristics['security'][7]);
        }


        public function it_must_have_all_internal_definition()
        {
            $stringao = str_repeat('1', 25);

            $apartament = $this->getApartament($stringao);

            $this->assertCount(26, $apartament->characteristics['internal_area']);
            $this->assertEquals('varanda', $apartament->characteristics['internal_area'][25]);


        }


        /** @test */
        public function it_must_detect_the_correct_room_numbers()
        {
            $house = $this->getApartament();

            $this->assertEquals(4, $house->bedroom);
            $this->assertEquals(2, $house->suite);
            $this->assertEquals(3, $house->bathroom);
            $this->assertEquals(1, $house->room);
            $this->assertEquals(5, $house->kitchen);
            $this->assertEquals(6, $house->garage_lot);
            $this->assertEquals(9, $house->housekeeper_room);
            $this->assertEquals(7, $house->lavatory);

        }

        public function getApartament(
            $definition01 = '1',
            $definicaoMaster = '1',
            $definicao02 = '1',
            $definicao03 = '1',
            $definicao04 = '1',
            $definicao05 = '1'
        ) {
            $std = new stdClass();

            $std->definicao_01 = $definition01;
            $std->definicao_master = $definicaoMaster;
            $std->definicao_02 = $definicao02;
            $std->definicao_03 = $definicao03;
            $std->definicao_04 = $definicao04;
            $std->definicao_05 = $definicao05;

            $std->dorms = 4;
            $std->suites = 2;
            $std->banheiros = 3;
            $std->salas = 1;
            $std->cozinhas = 5;
            $std->vagas_garagem = 6;
            $std->area_servico = 8;
            $std->dep_empregada = 9;
            $std->lavabos = 7;

            return new \Microsistec\DbParser\Definition\PropertyType\Apartament($std);
        }


    }