<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 20/03/17
 * Time: 12:29
 */

namespace Microsistec\DbParser\Parser\Desktop;


use Microsistec\DbParser\Customer;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;

class JuridicalCustomerParser extends ParserAbstract implements ParserInterface
{

    public function parse($model, $domain = "", $account = "")
    {
        $customer                            = new Customer();
        $customer->maintence_id              = (int)$model->id;
        $customer->id                        = (int)$model->id;
        $customer->code                      = (int)$model->id;
        $customer->name                      = $model->corporate_name;
        $customer->status                    = 0;
        $customer->type                      = 2;
        $customer->user_id                   = 1;
        $customer->zipcode                   = $this->unMask($model->zipcode);
        $customer->street                    = $model->street;
        $customer->street_number             = $model->number;
        $customer->complementary             = $model->complementary;
        $customer->city                      = $model->city;
        $customer->neighborhood              = $model->neighborhood;
        $customer->state                     = $model->state;
        $customer->state_id                  = $this->getState($model->state);
        $customer->opening_date              = $this->formatDate($model->opening_date);
        $customer->fantasy_name              = $model->fantasy_name;
        $customer->cnpj                      = $this->unMask($model->cnpj);
        $customer->ie                        = $this->unMask($model->ie);
        $customer->im                        = $this->unMask($model->im);
        $customer->income                    = $model->income;
        $customer->bank_name                 = $model->bank_name;
        $customer->bank_agency               = $model->bank_agency;
        $customer->bank_account              = $model->bank_account;
        $customer->branch_id                 = $model->juridical_branch;
        $customer->emails                    = $this->parseEmails($model->emails);
        $customer->phones                    = $this->parsePhones($model->phones);
        $customer->deleted_at                = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;
        $customer->information               = $model->information;

        $encodedCustomer = new Customer();

        foreach ($customer as $key => $value) {

            $encodedCustomer->{$key} = $value !== '' ? $value : null;

            if (!empty($value) && is_scalar($value)) {

                if(!is_int($value)) {
                    $encodedCustomer->{$key} = utf8_encode(utf8_decode($value));
                }

                continue;
            }


        }

        return $encodedCustomer;
    }

}