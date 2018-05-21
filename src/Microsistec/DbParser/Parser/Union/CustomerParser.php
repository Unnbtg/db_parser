<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 07/05/18
 * Time: 09:15
 */

namespace Microsistec\DbParser\Parser\Union;


use Microsistec\DbParser\Customer;
use Microsistec\DbParser\Parser\ParserInterface;

class CustomerParser extends AbstractParser implements ParserInterface
{

    protected $maritalStatus = [
        ['id' => 1, 'name' => 'casado(a)'],
        ['id' => 2, 'name' => 'solteiro(a)'],
        ['id' => 3, 'name' => 'divorciado novo'],
        ['id' => 4, 'name' => 'viuvo(a)'],
        ['id' => 5, 'name' => 'sep.judicial'],
        ['id' => 6, 'name' => 'união estável'],
        ['id' => 0, 'name' => 'desquitado'],
    ];

    protected $gender = [
        ['id' => 1, 'name' => 'masculino'],
        ['id' => 2, 'name' => 'feminino'],
    ];

    protected $status = [
        ['id' => 1, 'name' => 'ativo'],
        ['id' => 2, 'name' => 'inativo'],
    ];

    protected $degree_levels = [
        ["id" => 1, "name" => "primeiro grau completo"],
        ["id" => 2, "name" => "primeiro grau incompleto"],
        ["id" => 3, "name" => "segundo grau incompleto"],
        ["id" => 4, "name" => "segundo grau completo"],
        ["id" => 5, "name" => "superior incompleto"],
        ["id" => 6, "name" => "superior completo"],
        //["id" => 7, "name" => "pós graduação incompleto"],
        ["id" => 8, "name" => "pos-graduação"],
        //["id" => 9, "name" => "mestrado incompleto"],
        ["id" => 10, "name" => "mestrado"],
        //["id" => 11, "name" => "doutorado incompleto"],
        ["id" => 12, "name" => "doutorado"],
        ["id" => 13, "name" => "não especificado"],
    ];


    private $id;

    public function parse($model, $domain = "", $account = "")
    {
        $customer = new Customer();

        $this->id = (int)trim($model->codcli);

        $customer->id                        = (int)trim($model->codcli);
        $customer->maintence_id              = (int)trim($model->codcli);
        $customer->name                      = (string)trim($model->nome);
        $customer->user_id                   = 1;
        $customer->broker_id                 = (int)trim($model->fkcorretor);
        $customer->cpf                       = (string)trim($model->cnpj_cpf);
        $customer->street                    = (string)trim($model->endereco);
        $customer->street_number             = (string)trim($model->numero);
        $customer->complementary             = (string)trim($model->complemento);
        $customer->neighborhood              = (string)trim($model->bairro);
        $customer->city                      = (string)trim($model->cidade);
        $customer->state                     = (string)trim($model->uf);
        $customer->zipcode                   = (string)trim($model->cep);
        $customer->rg                        = (string)trim($model->ie_rg);
        $customer->rg_issuer                 = (string)trim($model->orgao_expeditor);
        $customer->rg_issued_at              = $this->formatDate(trim($model->data_expedicao));
        $customer->birthdate                 = $this->formatDate(trim($model->nascimento));
        $customer->marital_status            = $this->parseMaritalStatus(trim((string)$model->civil));
        $customer->occupation                = (string)trim($model->profissao);
        $customer->nationality               = (string)trim($model->nacionalidade);
        $customer->naturalness               = (string)trim($model->naturalidade);
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
        $customer->degree_level              = $this->getFromComplexConfig(strtolower(trim((string)$model->escolaridade)), $this->degree_levels);
        $customer->gender                    = ($this->getFromComplexConfig(strtolower(trim((string)$model->sexo)), $this->gender)) ? $this->getFromComplexConfig(strtolower(trim((string)$model->sexo)), $this->gender) : null;
        $customer->status                    = $this->getFromComplexConfig(strtolower(trim((string)$model->ativo)), $this->status);
        $customer->code                      = (int)trim($model->codcli);
        $customer->type                      = (int)trim($model->pessoa);
        $customer->cnpj                      = null;
        $customer->branch_id                 = null;
        $customer->owner                     = false;
        $customer->interested                = false;
        $customer->emails                    = $this->parseEmail(trim((string)$model->email));
        $customer->phones                    = $this->parsePhones($model);
        $customer->created_at                = $this->formatDate(trim($model->datacad));
        $customer->updated_at                = $this->formatDate(trim($model->dataatua));

        return $customer;
    }

    private function parseMaritalStatus($maritalStatus)
    {
        if (empty($maritalStatus)) {
            return null;
        }

        $marital = $this->simplifyConfig($this->maritalStatus);

        if (!in_array($maritalStatus, $marital)) {
            return null;
        }

        return $marital[strtolower($maritalStatus)];
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

        if (trim($model->prefix_tel1) && trim($model->telefone1)) {
            $phone        = new \stdClass();
            $phone->phone = trim($model->prefix_tel1) . $this->unMask(trim($model->telefone1));
            $phones[]     = $phone;
        }
        if (trim($model->prefix_tel2) && trim($model->telefone2)) {
            $phone        = new \stdClass();
            $phone->phone = trim($model->prefix_tel2) . $this->unMask(trim($model->telefone2));
            $phones[]     = $phone;
        }
        if (trim($model->prefix_tel3) && trim($model->telefone3)) {
            $phone        = new \stdClass();
            $phone->phone = trim($model->prefix_tel3) . $this->unMask(trim($model->telefone2));
            $phones[]     = $phone;
        }
        if (trim($model->celular)) {
            $phone        = new \stdClass();
            $phone->phone = trim($model->prefix_cel) . $this->unMask(trim($model->celular));
            $phones[]     = $phone;
        }

        return $phones;
    }

}