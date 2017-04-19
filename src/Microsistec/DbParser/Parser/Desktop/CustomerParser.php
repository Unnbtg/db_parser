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
        0 => 2, //Solteiro
        1 => 1, //Casado
        2 => 5, //Separado
        3 => 3, //Divorciado
        4 => 4, //Viuvo
        5 => 6, //União estável
        6 => null,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $customer                            = new Customer();
        $customer->maintence_id              = (int)$model->id;
        $customer->id                        = (int)$model->id;
        $customer->code                      = (int)$model->code;
        $customer->branch_id                 = (int)$model->branch_id;
        $customer->name                      = $model->name;
        $customer->status                    = 0;
        $customer->type                      = 1;
        $customer->user_id                   = 1;
        $customer->cpf                       = $this->unMask($model->cpf);
        $customer->zipcode                   = $this->unMask($model->zipcode);
        $customer->street                    = $model->street;
        $customer->street_number             = $model->number;
        $customer->complementary             = $model->complementary;
        $customer->city                      = $model->city;
        $customer->neighborhood              = $model->neighborhood;
        $customer->state                     = $this->getState($model->state);
        $customer->rg                        = str_replace(['.', '-'], '', $model->rg);
        $customer->issued_at                 = $this->formatDate($model->rg_issued_at);
        $customer->issuer                    = $model->rg_issuer;
        $customer->birthdate                 = $this->formatDate($model->birthdate);
        $customer->marital_status            = $model->marital_status != "" ? $this->marital_status[$model->marital_status] : null;
        $customer->occupation                = $model->occupation;
        $customer->nationality               = $model->nationality;
        $customer->naturalness               = $model->naturalness;
        $customer->paternal_filiation        = $model->paternal_filiation;
        $customer->maternal_filiation        = $model->maternal_filiation;
        $customer->spouse_name               = $model->spouse_name;
        $customer->spouse_cpf                = $this->unMask($model->spouse_cpf);
        $customer->spouse_rg                 =  str_replace(['.', '-'], '', $model->spouse_rg);
        $customer->spouse_rg_issued_at       = $this->formatDate($model->spouse_rg_issued_at);
        $customer->spouse_rg_issuer          = $model->spouse_rg_issuer;
        $customer->spouse_birthdate          = $this->formatDate($model->spouse_birthdate);
        $customer->spouse_marital_status     = $model->spouse_marital_status != "" ? $this->marital_status[$model->spouse_marital_status] : null;
        $customer->spouse_occupation         = $model->spouse_occupation;
        $customer->spouse_nationality        = $model->spouse_nationality;
        $customer->spouse_naturalness        = $model->spouse_naturalness;
        $customer->spouse_paternal_filiation = $model->spouse_paternal_filiation;
        $customer->spouse_maternal_filiation = $model->spouse_maternal_filiation;
        $customer->union_date                = $this->formatDate($model->union_date);
        $customer->union_security            = $model->union_security;
        $customer->income                    = $model->income;
        $customer->bank_account              = $model->bank_account;
        $customer->bank_name                 = $model->bank_name;
        $customer->bank_agency               = $model->bank_agency;
        $customer->owner                     = false;
        $customer->interested                = false;
        $customer->emails                    = $this->parseEmails($model->emails);

        $customer->phones                    = $this->parsePhones($model->phones);
        $customer->deleted_at                = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;

        $encodedCustomer = new Customer();

        foreach ($customer as $key => $value) {

            $encodedCustomer->{$key} = $value !== '' ? $value : null;

            if (!empty($value) && is_string($value)) {
               $encodedCustomer->{$key} = utf8_encode(utf8_decode($value));
            }

        }

        return $encodedCustomer;
    }

}