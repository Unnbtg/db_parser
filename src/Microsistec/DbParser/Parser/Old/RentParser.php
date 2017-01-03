<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 11:28
     */

    namespace Microsistec\DbParser\Parser\Old;


    use Microsistec\DbParser\Definition\MassAssignmentable;

    class RentParser
    {
        public function parse($model, MassAssignmentable $massAssignmentable, $object = null)
        {
            if (is_null($object)) {
                $object = new \Microsistec\DbParser\Definition\Disponibility\Rent;
            }
            if($model->pagto_opcoes != null)
            {
                $massAssignmentable->massAssignment($object , $model->pagto_opcoes, $this->getPaymentOptions());
                $object->value = $model->valor_locacao;
            }
            return $object ;
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