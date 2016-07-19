<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 04/07/16
 * Time: 11:16
 */


class SellTest extends PHPUnit_Framework_TestCase 
{

    /** @test */
    public function it_must_correctly_detect_the_payment_methods()
    {
        $sell = $this->getSellDisponibility('11111111111111');

        $this->assertTrue($sell->financingBank);
        $this->assertTrue($sell->financingDirect);
        $this->assertTrue($sell->exchange);
        $this->assertTrue($sell->inCash);
        $this->assertTrue($sell->fgts);
        $this->assertTrue($sell->letterCredit);
    }

    /** @test */
    public function it_must_correctly_detect_the_fgts_is_disabled()
    {
        $sell = $this->getSellDisponibility('01111111111111');

        $this->assertTrue($sell->financingBank);
        $this->assertTrue($sell->financingDirect);
        $this->assertTrue($sell->exchange);
        $this->assertTrue($sell->inCash);
        $this->assertFalse($sell->fgts);
        $this->assertTrue($sell->letterCredit);
    }


    /** @test */
    public function it_must_correctly_detect_the_letter_of_credit_is_disabeld()
    {
        $sell = $this->getSellDisponibility('10111111111111');

        $this->assertTrue($sell->financingBank);
        $this->assertTrue($sell->financingDirect);
        $this->assertTrue($sell->exchange);
        $this->assertTrue($sell->inCash);
        $this->assertTrue($sell->fgts);
        $this->assertFalse($sell->letterCredit);
    }

    /** @test */
    public function it_must_correctly_detect_the_in_cash_is_disabled()
    {
        $sell = $this->getSellDisponibility('11011111111111');

        $this->assertTrue($sell->financingBank);
        $this->assertTrue($sell->financingDirect);
        $this->assertTrue($sell->exchange);
        $this->assertFalse($sell->inCash);
        $this->assertTrue($sell->fgts);
        $this->assertTrue($sell->letterCredit);
    }

     /** @test */
    public function it_must_correctly_detect_the_exchange_properly_enabled()
    {
        $sell = $this->getSellDisponibility('11111111000011');

        $this->assertTrue($sell->financingBank);
        $this->assertTrue($sell->financingDirect);
        $this->assertFalse($sell->exchange);
        $this->assertTrue($sell->inCash);
        $this->assertTrue($sell->fgts);
        $this->assertTrue($sell->letterCredit);

        $sell = $this->getSellDisponibility('11111111100011');
        $this->assertTrue($sell->exchange);

        $sell = $this->getSellDisponibility('11111111010011');
        $this->assertTrue($sell->exchange);

        $sell = $this->getSellDisponibility('11111111001011');
        $this->assertTrue($sell->exchange);

        $sell = $this->getSellDisponibility('11111111000111');
        $this->assertTrue($sell->exchange);

    }

     /** @test */
    public function it_must_correctly_detect_the_direct_financing_is_disabled()
    {
        $sell = $this->getSellDisponibility('11111111111101');

        $this->assertTrue($sell->financingBank);
        $this->assertFalse($sell->financingDirect);
        $this->assertTrue($sell->exchange);
        $this->assertTrue($sell->inCash);
        $this->assertTrue($sell->fgts);
        $this->assertTrue($sell->letterCredit);

    }

     /** @test */
    public function it_must_correctly_detect_the_bank_financing_is_disabled()
    {
        $sell = $this->getSellDisponibility('11111111111110');

        $this->assertFalse($sell->financingBank);
        $this->assertTrue($sell->financingDirect);
        $this->assertTrue($sell->exchange);
        $this->assertTrue($sell->inCash);
        $this->assertTrue($sell->fgts);
        $this->assertTrue($sell->letterCredit);

    }


    protected function getSellDisponibility($pagto)
    {
        $std = new stdClass();

        $std->pagto_opcoes = $pagto;
        $std->pagto_mensais_qtd = 10;
        $std->pagto_mensais_valor = 150000.50;
        $std->valor_venda = 65400000.00;

        $sell = new \Microsistec\DbParser\Parser\Old\SellParser();
        return $sell->parse($std, new \Microsistec\DbParser\Definition\OldMasSAssignment());
    }

}