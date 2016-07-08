<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 05/07/16
     * Time: 14:46
     */
    class TerrainTest extends PHPUnit_Framework_TestCase
    {


        /** @test */
        public function it_must_detect_subtype_as_simples()
        {
            $terrain = $this->getTerrain('0');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::SIMPLES, $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_incorporacao()
        {
            $terrain = $this->getTerrain('1');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::INCORPORACAO, $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_sitio()
        {
            $terrain = $this->getTerrain('2');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::SITIO, $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_fazenda()
        {
            $terrain = $this->getTerrain('3');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::FAZENDA, $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_chacara()
        {
            $terrain = $this->getTerrain('4');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::CHACARA, $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_loteamento()
        {
            $terrain = $this->getTerrain('5');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::LOTEAMENTO, $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_area_industrial()
        {
            $terrain = $this->getTerrain('6');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::AREA_INDUSTRIAL,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_condominio_fechado()
        {
            $terrain = $this->getTerrain('7');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::CONDOMINIO_FECHADO,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_terreno_residencial()
        {
            $terrain = $this->getTerrain('8');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::TERRENO_RESIDENCIAL,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_terreno_comercial()
        {
            $terrain = $this->getTerrain('9');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::TERRENO_COMERCIAL,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_empreendimento()
        {
            $terrain = $this->getTerrain('10');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::EMPREENDIMENTO,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_area_comercial()
        {
            $terrain = $this->getTerrain('11');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::AREA_COMERCIAL,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_area_residencial()
        {
            $terrain = $this->getTerrain('12');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::AREA_RESIDENCIAL,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_area_portuaria()
        {
            $terrain = $this->getTerrain('13');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::AREA_PORTUARIA,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_area_area_retroportuaria()
        {
            $terrain = $this->getTerrain('14');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::AREA_RETROPORTUARIA,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_detect_subtype_as_terreno_industrial()
        {
            $terrain = $this->getTerrain('15');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::TERRENO_INDUSTRIAL,
                $terrain->subtype);
        }

        /** @test */
        public function it_must_fetch_all_terrain_proximities()
        {
            $house = $this->getTerrain('1', str_repeat('1', 6));

            $this->assertCount(6, $house->characteristics['proximity']);
            $this->assertEquals('rua_calcada', $house->characteristics['proximity'][5]);
        }

        /** @test */
        public function it_must_fetch_all_terrain_needs()
        {
            $house = $this->getTerrain('1', str_repeat('0', 6) . str_repeat('1', 4));

            $this->assertCount(4, $house->characteristics['needs']);
            $this->assertEquals('aterro', $house->characteristics['needs'][3]);
        }

        /** @test */
        public function it_must_fetch_all_terrain_definition()
        {
            $house = $this->getTerrain('1', str_repeat('0', 10) . str_repeat('1', 6));
            $this->assertCount(5, $house->characteristics['definition']);
            $this->assertEquals('alto_padrao', $house->characteristics['definition'][4]);
        }

        /** @test */
        public function it_must_have_a_ground_type()
        {
            $house = $this->getTerrain(1, 1, '5');

            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Terrain::GROUND_TYPE_PLANO,
                $house->ground_type);
        }

        public function getTerrain($definicao01 = '1', $definicao_master = '0', $definicao_02 = '1')
        {
            $std = new stdClass();

            $std->definicao_01 = $definicao01;
            $std->definicao_master = $definicao_master;
            $std->definicao_02 = $definicao_02;

            return new \Microsistec\DbParser\Definition\PropertyType\Terrain($std);
        }

    }