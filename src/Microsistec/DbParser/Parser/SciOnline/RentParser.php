<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 12/07/16
     * Time: 12:11
     */

    namespace Microsistec\DbParser\Parser\SciOnline;


    use Microsistec\DbParser\Definition\Disponibility\Rent;

    class RentParser
    {
        public function parse($model)
        {
            $rent =  new Rent;

            $rent->value = $model->rent_value;
            $rent->deposit = $model->deposit;
            $rent->guarantor = $model->guarantor;
            $rent->secureBail = $model->lessor_bail;
            $rent->requiresDeed = $model->required_guarantor_deed;

            return $rent;
        }
    }