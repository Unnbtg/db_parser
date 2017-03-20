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

class CustomerParser extends ParserAbstract implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $customer                            = new Customer();
        $customer->id                        = $model->id;
        $customer->code                      = $model->id;
        $customer->name                      = $model->name;
        $customer->status                    = 0;
        $customer->type                      = 1;
        $customer->user_id                   = 1;
        $customer->cpf                       = $model->cpf;
        $customer->zipcode                   = $this->maskCep($model->zipcode);

        $addressService                      = new ZipCodeService();
        $result                              = $addressService->getAddress($model->zipcode);
        $customer->neighborhood_id           = $result['id_bairro'];
        $customer->city_id                   = $result['id_cidade'];
        $customer->state_id                  = $this->getState($result['id_uf']);

        $customer->street                    = $model->street;
        $customer->street_number             = $model->street_number;
        $customer->complementary             = $model->complementary;
        $customer->city                      = $model->city;
        $customer->state                     = $model->state;
        $customer->neighborhood              = $model->neighborhood;
        $customer->rg                        = $model->rg;
        $customer->issuer                    = $model->issuer;
        $customer->issued_at                 = $model->issued_at;
        $customer->birthdate                 = $model->birthdate;
        $customer->marital_status            = $model->marital_status;
        $customer->occupation                = $model->occupation;
        $customer->nationality               = $model->nationality;
        $customer->naturalness               = $model->naturalness;
        $customer->paternal_filiation        = $model->paternal_filiation;
        $customer->maternal_filiation        = $model->maternal_filiation;
        $customer->spouse_name               = $model->spouse_name;
        $customer->spouse_cpf                = $model->spouse_cpf;
        $customer->spouse_rg                 = $model->spouse_rg;
        $customer->spouse_rg_issuer          = $model->spouse_rg_issuer;
        $customer->spouse_rg_issued_at       = $model->spouse_rg_issued_at;
        $customer->spouse_birthdate          = $model->spouse_birthdate;
        $customer->spouse_marital_status     = $model->spouse_marital_status;
        $customer->spouse_occupation         = $model->spouse_occupation;
        $customer->spouse_nationality        = $model->spouse_nationality;
        $customer->spouse_naturalness        = $model->spouse_naturalness;
        $customer->spouse_paternal_filiation = $model->spouse_paternal_filiation;
        $customer->spouse_maternal_filiation = $model->spouse_maternal_filiation;
        $customer->union_date                = $model->union_date;
        $customer->union_security            = $model->union_security;
        $customer->income                    = $model->income;
        $customer->bank_name                 = $model->bank_name;
        $customer->bank_agency               = $model->bank_agency;
        $customer->bank_account              = $model->bank_account;
        $customer->owner                     = null;
        $customer->interested                = null;
        $customer->children                  = null;
        $customer->autos                     = null;
        $customer->gender                    = null;
        $customer->branch_id                 = $model->branch_id;
        $customer->emails                    = $model->emails;
        $customer->phones                    = $model->phones;
    }

}