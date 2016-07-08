<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 06/07/16
     * Time: 10:39
     */
    class CommercialTest extends PHPUnit_Framework_TestCase
    {


        /** @test */
        public function it_must_have_a_subtype()
        {
            $commercial = $this->getCommercial('0');
            $this->assertEquals(\Microsistec\DbParser\Definition\PropertyType\Commercial::LOJA, $commercial->subtype);
        }

        /** @test */
        public function it_must_fetch_all_internal_options()
        {
            $stringao = $this->buildStringao(0,4,34);

            $commercial = $this->getCommercial('0', $stringao);

            $this->assertCount(34, $commercial->characteristics['internal']);
            $this->assertCount(0, $commercial->characteristics['kitchen']);
            $this->assertCount(0, $commercial->characteristics['bathroom']);
            $this->assertCount(0, $commercial->characteristics['front']);
            $this->assertCount(0, $commercial->characteristics['more_itens']);


            $this->assertEquals('ventilador_teto', $commercial->characteristics['internal'][33]);
        }

        /** @test */
        public function it_must_fetch_all_internal_kitchen()
        {
            $stringao = $this->buildStringao(1,3,34);

            $commercial = $this->getCommercial('0', $stringao);

            $this->assertCount(0, $commercial->characteristics['internal']);
            $this->assertCount(34, $commercial->characteristics['kitchen']);
            $this->assertCount(0, $commercial->characteristics['bathroom']);
            $this->assertCount(0, $commercial->characteristics['front']);
            $this->assertCount(0, $commercial->characteristics['more_itens']);


            $this->assertEquals('ventilador_teto', $commercial->characteristics['kitchen'][33]);
        }
        /** @test */
        public function it_must_fetch_all_internal_bathroom()
        {
            $stringao = $this->buildStringao(2,2,34);

            $commercial = $this->getCommercial('0', $stringao);

            $this->assertCount(0, $commercial->characteristics['internal']);
            $this->assertCount(0, $commercial->characteristics['kitchen']);
            $this->assertCount(34, $commercial->characteristics['bathroom']);
            $this->assertCount(0, $commercial->characteristics['front']);
            $this->assertCount(0, $commercial->characteristics['more_itens']);


            $this->assertEquals('ventilador_teto', $commercial->characteristics['bathroom'][33]);
        }
        /** @test */
        public function it_must_fetch_all_internal_front()
        {
            $stringao = $this->buildStringao(3,1,34);

            $commercial = $this->getCommercial('0', $stringao);

            $this->assertCount(0, $commercial->characteristics['internal']);
            $this->assertCount(0, $commercial->characteristics['kitchen']);
            $this->assertCount(0, $commercial->characteristics['bathroom']);
            $this->assertCount(34, $commercial->characteristics['front']);
            $this->assertCount(0, $commercial->characteristics['more_itens']);


            $this->assertEquals('ventilador_teto', $commercial->characteristics['front'][33]);
        }

        /** @test */
        public function it_must_fetch_all_internal_more_itens()
        {
            $stringao = $this->buildStringao(4,0,34);

            $commercial = $this->getCommercial('0', $stringao);

            $this->assertCount(0, $commercial->characteristics['internal']);
            $this->assertCount(0, $commercial->characteristics['kitchen']);
            $this->assertCount(0, $commercial->characteristics['bathroom']);
            $this->assertCount(0, $commercial->characteristics['front']);
            $this->assertCount(31, $commercial->characteristics['more_itens']);


            $this->assertEquals('papel_de_parede', $commercial->characteristics['more_itens'][30]);
        }


        protected function buildStringao($preZero = 0, $afterZeros = 0, $numberRepetitions)
        {
            return  str_repeat('0', $numberRepetitions * $preZero) .
                    str_repeat('1', $numberRepetitions) .
                    str_repeat("0", $numberRepetitions * $afterZeros);
        }

        /**
         * @param string $definicao_01
         *
         * @return \Microsistec\DbParser\Definition\PropertyType\Commercial
         */
        public function getCommercial($definicao_01 = '0', $definicao_master = '1', $definicao_02 = '1')
        {

            $std = new stdClass();

            $std->definicao_01 = $definicao_01;
            $std->definicao_master = $definicao_master;
            $std->definicao_02 = $definicao_02;

            return new \Microsistec\DbParser\Definition\PropertyType\Commercial($std);
        }
    }