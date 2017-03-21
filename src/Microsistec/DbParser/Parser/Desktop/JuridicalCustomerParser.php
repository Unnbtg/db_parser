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
        $customer->name                      = $model->name;
        $customer->status                    = 0;
        $customer->type                      = 2;
        $customer->user_id                   = 1;
        $customer->cpf                       = $this->unMask($model->cpf);
        $customer->zipcode                   = $this->maskCep($model->zipcode);

        $addressService                      = new ZipCodeService();

        $result                              = $addressService->getAddress($customer->zipcode);

        if($result){
            $customer->neighborhood_id           = $result->neighborhood_id;
            $customer->city_id                   = $result->city_id;
            $customer->state_id                  = $this->getState($result->state_id);
        }

        $customer->street                    = $model->street;
        $customer->street_number             = $model->number;
        $customer->complementary             = $model->complementary;
        $customer->city                      = $model->city;
        $customer->state                     = $model->state;
        $customer->neighborhood              = $model->neighborhood;
        $customer->rg                        = $this->unMask($model->rg);
        $customer->issued_at                 = $model->rg_issued_at;
        $customer->issuer                    = $model->rg_issuer;
        $customer->birthdate                 = $model->birthdate;
        $customer->marital_status            = isset($model->marital_status) ? $this->marital_status[$model->marital_status] : null;
        $customer->occupation                = $model->occupation;
        $customer->nationality               = $model->nationality;
        $customer->naturalness               = $model->naturalness;
        $customer->paternal_filiation        = $model->paternal_filiation;
        $customer->maternal_filiation        = $model->maternal_filiation;
        $customer->spouse_name               = $model->spouse_name;
        $customer->spouse_cpf                = $this->unMask($model->spouse_cpf);
        $customer->spouse_rg                 = $this->unMask($model->spouse_rg);
        $customer->spouse_rg_issued_at       = $model->spouse_rg_issued_at;
        $customer->spouse_rg_issuer          = $model->spouse_rg_issuer;
        $customer->spouse_birthdate          = $model->spouse_birthdate;
        $customer->spouse_marital_status     = isset($model->marital_status) ? $this->marital_status[$model->spouse_marital_status] : null;
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
        $customer->branch_id                 = $model->branch;
        $customer->emails                    = $model->emails;
        $customer->phones                    = $model->phones;

        return $customer;
    }

}