<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 22/12/16
 * Time: 13:09
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\FormProfile;

class FormProfileParser extends AbstractParser
{
    public function parse($model, $domain = "", $account = "")
    {
        $profile = new FormProfile();

        $profile->customer_id = $model['id cliente'];
        $profile->bedroom = $model['dormitorios'];
        $profile->parking_lots = $model['garagens'];
        $profile->max_price = $model['valor venda'];

        return $profile;
    }


}