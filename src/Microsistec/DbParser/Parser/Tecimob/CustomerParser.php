<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 27/09/18
 * Time: 10:19
 */

namespace Microsistec\DbParser\Parser\Tecimob;


use Microsistec\DbParser\Customer;
use Microsistec\DbParser\Formatter;
use Microsistec\DbParser\Parser\ParserInterface;

class CustomerParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $customer = new Customer();

        $customer->id = (int)$model['id'];
        if (!$customer->id) {
            return false;
        }
        $customer->maintence_id  = (int)$model['id'];
        $customer->name          = title_case($model['nome']);
        $customer->user_id       = -1;
        $customer->broker_id     = -1;
        $customer->street        = Formatter::stringValue(title_case($model['logradouro']));
        $customer->street_number = Formatter::stringValue($model['logradouro_numero']);
        $customer->complementary = Formatter::stringValue(title_case($model['complemento']));
        $customer->neighborhood  = Formatter::stringValue(title_case($model['bairro']), '--');
        $customer->city          = Formatter::stringValue(title_case($model['cidade']), '--');
        $customer->state         = Formatter::stringValue(strtoupper($model['uf']), '--');
        $customer->zipcode       = Formatter::stringValue($this->unMask($model['cep']));

        $customer->cpf                       = Formatter::stringValue(title_case($model['cpf_cnpj']));
        $customer->rg                        = Formatter::stringValue(title_case($model['rg']));
        $customer->rg_issuer                 = null;
        $customer->rg_issued_at              = null;
        $customer->birthdate                 = $this->formatDate($model['data_nascimento']);
        $customer->marital_status            = null;
        $customer->occupation                = null;
        $customer->nationality               = null;
        $customer->naturalness               = null;
        $customer->paternal_filiation        = null;
        $customer->maternal_filiation        = null;
        $customer->spouse_name               = null;
        $customer->spouse_cpf                = null;
        $customer->spouse_rg                 = null;
        $customer->spouse_rg_issued_at       = null;
        $customer->spouse_rg_issuer          = null;
        $customer->spouse_birthdate          = null;
        $customer->spouse_marital_status     = null;
        $customer->spouse_occupation         = null;
        $customer->spouse_nationality        = null;
        $customer->spouse_naturalness        = null;
        $customer->spouse_paternal_filiation = null;
        $customer->spouse_maternal_filiation = null;
        $customer->union_date                = null;
        $customer->union_security            = null;
        $customer->income                    = null;
        $customer->bank_name                 = null;
        $customer->bank_agency               = null;
        $customer->bank_account              = null;
        $customer->children                  = null;
        $customer->autos                     = null;
        $customer->degree_level              = null;
        $customer->gender                    = null;
        $customer->code                      = (int)$model['id'];
        $customer->type                      = 1;
        $customer->status                    = 1;
        $customer->cnpj                      = null;
        $customer->branch_id                 = null;
        $customer->owner                     = Formatter::booleanValue($model['proprietario']);
        $customer->interested                = Formatter::booleanValue($model['comprador']);

        $customer->phones = $this->parsePhones($model);

        $customer->created_at = $this->formatDate($model['data_cadastro']);
        $customer->updated_at = null;
        $customer->deleted_at = null;

        $customer->notes  = [];
        $customer->emails = [];

        if (!empty($model['observacao'])) {
            $customer->notes[] = $model['observacao'];
        }

        if (!empty($model['origem_captacao'])) {
            $customer->notes[] = 'Origem da captação: ' . $model['origem_captacao'];
        }

        if (!empty($model['email'])) {
            $customer->emails[] = strtolower($model['email']);
        }
        $i = 1;
        foreach ($model as $key => $value) {
            if (preg_match('/excedent_key_\d/', $key) && $value) {
                $customer->notes[] = 'informação de campo fora do padrão ' . $i . ': ' . $value;
                $i++;
            }
        }

        return $customer;
    }

}