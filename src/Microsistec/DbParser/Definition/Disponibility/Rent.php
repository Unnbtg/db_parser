<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 01/07/16
     * Time: 17:01
     */

    namespace Microsistec\DbParser\Definition\Disponibility;


    /**
     * Class Rent
     * @package Microsistec\DbParser\Definition\Disponibility
     *
     * @property bool  $secureBail        Seguro Fiança
     * @property bool  $guarantor         Fiador
     * @property bool  $deposit           Deposito
     * @property bool  $requiresDeed      Exige Escritura
     * @property float $value
     *
     */
    class Rent extends DisponibilityAbstract
    {
        /**
         * Seguro Fiança
         * Fiador
         * Depósito
         * Depositos Quantidade Minimo
         * Exige Escritura
         */


        public function __construct($model)
        {
            $this->getPaymentWays($model->pagto_opcoes);
            $this->value = $model->valor_locacao;
        }

        protected function getPaymentOptions()
        {
            return [
                4 => 'secureBail',
                'guarantor',
                'deposit',
                'requiresDeed',
            ];
        }


    }