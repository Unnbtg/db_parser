<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 04/07/16
     * Time: 15:32
     */
    class SeasonTest extends PHPUnit_Framework_TestCase
    {

        /** @test */
        public function it_must_detect_all_payment_ways_as_enabled()
        {
            $rent = $this->getRentDisponibility('00001111000000');

            $this->assertTrue($rent->guarantor);
            $this->assertTrue($rent->deposit);
            $this->assertTrue($rent->requiresDeed);
            $this->assertTrue($rent->secureBail);
        }

        /** @test */
        public function it_must_detect_all_secure_bail_is_disabled()
        {
            $rent = $this->getRentDisponibility('00000111000000');

            $this->assertTrue($rent->guarantor);
            $this->assertTrue($rent->deposit);
            $this->assertTrue($rent->requiresDeed);
            $this->assertFalse($rent->secureBail);
        }

        /** @test */
        public function it_must_detect_all_guarantor_is_disabled()
        {
            $rent = $this->getRentDisponibility('00001011000000');

            $this->assertFalse($rent->guarantor);
            $this->assertTrue($rent->deposit);
            $this->assertTrue($rent->requiresDeed);
            $this->assertTrue($rent->secureBail);
        }

        /** @test */
        public function it_must_detect_deposit_is_disabled()
        {
            $rent = $this->getRentDisponibility('00001101000000');

            $this->assertTrue($rent->guarantor);
            $this->assertFalse($rent->deposit);
            $this->assertTrue($rent->requiresDeed);
            $this->assertTrue($rent->secureBail);
        }

        /** @test */
        public function it_must_detect_requires_deed_is_disabled()
        {
            $rent = $this->getRentDisponibility('00001110000000');

            $this->assertTrue($rent->guarantor);
            $this->assertTrue($rent->deposit);
            $this->assertFalse($rent->requiresDeed);
            $this->assertTrue($rent->secureBail);
        }


        public function getRentDisponibility($opcoes)
        {
            $std = new stdClass();
            $std->pagto_opcoes = $opcoes;
            $std->valor_locacao = 4554;
            $std->valor_locacao_alta_temporada = 45454;
            $std->valor_locacao_baixa_temporada = 45454;
            return new \Microsistec\DbParser\Definition\Disponibility\Season($std);
        }


    }