<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 07/07/16
     * Time: 10:18
     */
    class RuralTest extends PHPUnit_Framework_TestCase
    {


        /** @test */
        public function it_must_detect_as_characa()
        {
            $rural = $this->getRural(0);

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Rural::CHACARA, $rural->subtype);
        }


        /** @test */
        public function it_must_detext_as_sitio()
        {
            $rural = $this->getRural(1);

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Rural::SITIO, $rural->subtype);
        }

        /** @test */
        public function it_must_detext_as_fazenda()
        {
            $rural = $this->getRural(2);

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Rural::FAZENDA, $rural->subtype);
        }

        /** @test */
        public function it_must_detext_as_haras()
        {
            $rural = $this->getRural(3);

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Rural::HARAS, $rural->subtype);
        }


        /** @test */
        public function it_must_detext_as_rancho()
        {
            $rural = $this->getRural(4);

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Rural::RANCHO, $rural->subtype);
        }


        /** @test */
        public function it_must_have_all_external_area()
        {
            $stringao = str_repeat('1', 11);

            $rural = $this->getRural(0, '1', $stringao);

            $this->assertCount(11, $rural->characteristics['external_area']);
            $this->assertEquals('sistema_seguranca', $rural->characteristics['external_area'][10]);
        }


        /** @test */
        public function it_must_have_all_improvements()
        {
            $stringao = str_repeat('1', 14);

            $rural = $this->getRural(0, $stringao);

            $this->assertCount(14, $rural->characteristics['improvements']);
            $this->assertEquals('mangueira', $rural->characteristics['improvements'][13]);
        }

        /** @test */
        public function it_must_have_all_infrastructure()
        {
            $stringao = str_repeat('1', 40);

            $rural = $this->getRural(0, '1', '1', $stringao);

            $this->assertCount(40, $rural->characteristics['infrastructure']);
            $this->assertEquals('corrego', $rural->characteristics['infrastructure'][39]);
        }

        /** @test */
        public function it_must_detect_the_correct_room_numbers()
        {
            $rural = $this->getRural();

            $this->assertEquals(4, $rural->bedroom);
            $this->assertEquals(2, $rural->suite);
            $this->assertEquals(3, $rural->bathroom);
            $this->assertEquals(1, $rural->room);
            $this->assertEquals(5, $rural->kitchen);
            $this->assertEquals(6, $rural->garage_lots);
            $this->assertEquals(9, $rural->housekeeper_room);
            $this->assertEquals(7, $rural->lavatory);

        }

        protected function getRural(
            $definicao_01 = 1,
            $definicao_02 = '1',
            $definicao_03 = '1',
            $definicao_master = '1'
        ) {
            $std = new stdClass();

            $std->definicao_01 = $definicao_01;
            $std->definicao_02 = $definicao_02;
            $std->definicao_03 = $definicao_03;
            $std->definicao_master = $definicao_master;


            $std->dorms = 4;
            $std->suites = 2;
            $std->banheiros = 3;
            $std->salas = 1;
            $std->cozinhas = 5;
            $std->vagas_garagem = 6;
            $std->area_servico = 8;
            $std->dep_empregada = 9;
            $std->lavabos = 7;


            return new \Microsistec\DbParser\Definition\PropertyType\Rural($std);
        }

    }