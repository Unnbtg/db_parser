<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 07/05/18
 * Time: 09:15
 */

namespace Microsistec\DbParser\Parser\Plug7;


use Microsistec\DbParser\Customer;
use Microsistec\DbParser\Parser\ParserInterface;

class CustomerParser extends AbstractParser implements ParserInterface
{



    private $id;

    public function parse($model, $domain = "", $account = "")
    {
        $customer = new Customer();

        $this->id = (int)trim($model->id);

        $customer->id                        = (int)trim($model->id);
        $customer->maintence_id              = (int)trim($model->id);
        $customer->name                      = (string)trim($model->nome);
        $customer->user_id                   = 1;
        $customer->broker_id                 = (int)trim($model->usuario_id);
        $customer->cpf                       = (string)trim($model->cpf);
        $customer->street                    = (string)trim($model->logradouro);
        $customer->street_number             = (string)trim($model->numero);
        $customer->complementary             = (string)trim($model->complemento);
        $customer->neighborhood              = (string)trim($model->bairro);
        $customer->city                      = (string)trim($model->cidade);
        $customer->state                     = (string)trim($model->estado);
        $customer->zipcode                   = (string)trim($model->cep);
        $customer->rg                        = (string)trim($model->rg);
        $customer->rg_issuer                 = (string)trim($model->orgao_expedidor);
        $customer->rg_issued_at              = $this->formatDate(trim($model->data_expedicao));
        $customer->birthdate                 = $this->formatDate(trim($model->data_nascimento));
        $customer->marital_status            = null;
        $customer->occupation                = (string)trim($model->profissao);
        $customer->nationality               = null;
        $customer->naturalness               = null;
        $customer->paternal_filiation        = null;
        $customer->maternal_filiation        = null;
        $customer->spouse_name               = (string)trim($model->conjuge);
        $customer->spouse_cpf                = (string)trim($model->cpf_conjuge) ?: null;
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
        $customer->status                    = 1;
        $customer->code                      = (int)trim($model->id);
        $customer->type                      = 1;
        $customer->cnpj                      = null;
        $customer->branch_id                 = null;
        $customer->owner                     = false;
        $customer->interested                = false;
        $customer->emails                    = $this->parseEmail(trim((string)$model->email));
        $customer->phones                    = $this->parsePhones($model);
        $customer->created_at                = null;
        $customer->updated_at                = null;
        $customer->deleted_at                = $this->formatDate(trim($model->deletado));

        $customer->notes = [];
        if (!empty(trim((string)$model->observacao))) {
            $customer->notes[] = trim((string)$model->observacao);
        }

        $query = \DB::connection('mongoconnection')->collection('contatos');

        $contact = $query->where('customer_id', $customer->id)->first();

        if (!is_null($contact)) {
            $phone        = new \stdClass();
            $phone->phone = $this->unMask(trim($contact['phone']));
            $customer->phones[] = $phone;
        }

        return $customer;
    }

    private function parseEmail($email)
    {
        if (empty($email)) {
            return [];
        }

        $email = array_map('trim', explode(',', $email));
        $email = is_array($email) ? $email : [$email];

        return $email;
    }

    protected function parsePhones($model)
    {
        $phones = [];

        if (trim($model->tel)) {
            $phone        = new \stdClass();
            $phone->phone = $this->unMask(trim($model->tel));
            $phones[]     = $phone;
        }

        if (trim($model->tel2)) {
            $phone        = new \stdClass();
            $phone->phone = $this->unMask(trim($model->tel2));
            $phones[]     = $phone;
        }


        return $phones;
    }

}