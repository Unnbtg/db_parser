<?php

    namespace Microsistec\DbParser\Parser\SciOnline;

    use Microsistec\DbParser\Definition\Disponibility\Sell;

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 12:06
     */
    class SellParser
    {
        public function parse($model)
        {
            $sell = new Sell;

            $sell->letterCredit = $model->letter_of_credit;
            $sell->fgts = $model->fgts;
            $sell->financingBank = $model->bank_financing;
            $sell->financingDirect = $model->direct_finanfing;
            $sell->inCash = true;
            $sell->value = $model->sell_price;

            return $sell;
        }
    }