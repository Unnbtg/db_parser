<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 07/05/18
 * Time: 09:15
 */

namespace Microsistec\DbParser\Parser\Plug7;


use Microsistec\DbParser\CustomerContact;
use Microsistec\DbParser\Parser\ParserInterface;

class CustomerContactParser extends AbstractParser implements ParserInterface
{

    public function parse($model, $domain = "", $account = "")
    {
        $customer = new CustomerContact();

        $customer->id          = (int)trim($model->id);
        $customer->customer_id = (int)trim($model->proprietario_id);
        $customer->phone       = $this->unMask(trim($model->valor));

        return $customer;
    }

}