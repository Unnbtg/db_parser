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
use Microsistec\DbParser\ZipCodeService;

class JuridicalCustomerParser extends ParserAbstract implements ParserInterface
{
    /*
     * Online:                   Desktop:
     * 1 - casado                0 - solteiro
     * 2 - solteiro              1 - casado
     * 3 - divorciado            2 - separado
     * 4 - viúvo                 3 - divorciado
     * 5 - separado              4 - viuvo
     * 6 - união estável         5 - união estável
     *                           6 - outro
     */
    protected $marital_status = [
        0 => 2,
        1 => 1,
        2 => 5,
        3 => 3,
        4 => 4,
        5 => 6,
        6 => null,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $customer                            = new Customer();
        $customer->maintence_id              = $model->id;
        $customer->id                        = $model->id;
        $customer->code                      = $model->id;
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
        $customer->emails                    = $model->emails;
        $customer->phones                    = $model->phones;

        return $customer;
    }

}