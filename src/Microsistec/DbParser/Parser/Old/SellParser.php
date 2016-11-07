<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 11:08
     */

    namespace Microsistec\DbParser\Parser\Old;


    use Microsistec\DbParser\Definition\MassAssignmentable;

    class SellParser
    {
        protected $model;

        /**
         * @param                    $model
         * @param MassAssignmentable $massAssignmentable
         *
         * @return \Microsistec\DbParser\Definition\Disponibility\Sell
         */
        public function parse($model, MassAssignmentable $massAssignmentable)
        {
            $sell = new \Microsistec\DbParser\Definition\Disponibility\Sell();

            $sell->financing_fee_qtd = $model->pagto_mensais_qtd;
            $sell->financing_fee_value = $model->pagto_mensais_valor;
            $sell->value = $model->valor_venda;

            if($model->pagto_opcoes != null)
            {
                $massAssignmentable->massAssignment($sell, $model->pagto_opcoes, $this->getPaymentOptions());
            }
            return $sell;
        }

        protected function getPaymentOptions()
        {
            return [
                'fgts',
                'letterCredit',
                'inCash',
                4 => 'Seguro Fiança',
                'Fiador',
                'Depósito',
                'Exige Escritura Fiador',
                'exchange',
                'exchange',
                'exchange',
                'exchange',
                'financingDirect',
                'financingBank',
            ];
        }
    }