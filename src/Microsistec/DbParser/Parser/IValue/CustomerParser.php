<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 17:43
 */

namespace Microsistec\DbParser\Parser\IValue;

use Microsistec\DbParser\Customer;
use Microsistec\DbParser\CustomerEmail;
use Microsistec\DbParser\CustomerNote;
use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\Phone;
use Microsistec\DbParser\ZipCodeService;

class CustomerParser extends AbstractParser
{
    protected $id;

    protected $phoneTypes = [
        "Tel. Residencial" => "home",
        "Tel. Comercial"   => 'work',
        "Celular"          => 'mobile',
    ];

    protected $sourceType = [
        ['id' => 1, 'name' => "123i"],
        ['id' => 2, 'name' => "canal do imóvel"],
        ['id' => 3, 'name' => "captação"],
        ['id' => 4, 'name' => "cartão"],
        ['id' => 5, 'name' => "jornal"],
        ['id' => 6, 'name' => "outdoor"],
        ['id' => 7, 'name' => "site da imobiliária"],
        ['id' => 8, 'name' => "sites parceiros"],
        ['id' => 9, 'name' => "telefone"],
        ['id' => 10, 'name' => "viva real"],
    ];

    protected $maritalStatus = [
        ['id' => 1, 'name' => 'casado(a)'],
        ['id' => 2, 'name' => 'solteiro(a)'],
        ['id' => 3, 'name' => 'divorciado'],
        ['id' => 3, 'name' => 'divorciado(a)'],
        ['id' => 4, 'name' => 'viúvo'],
        ['id' => 4, 'name' => 'viúvo(a)'],
        ['id' => 5, 'name' => 'separado'],
        ['id' => 6, 'name' => 'união estável'],
        ['id' => 0, 'name' => 'não informado'],
    ];

    protected $status = [
        ['id' => 1, 'name' => 'sim'],
        ['id' => 2, 'name' => 'não'],
    ];

    protected $attorney = [
        ['id' => 1, 'name' => 'sim'],
        ['id' => 2, 'name' => 'nao'],
    ];

    protected $gender = [
        ['id' => 1, 'name' => 'masculino'],
        ['id' => 2, 'name' => 'feminino'],
    ];

    protected $type = [
        ['id' => 1, 'name' => 'fisica'],
        ['id' => 2, 'name' => 'juridica'],
    ];

    protected $degree_levels = [
        ["id" => 1, "name" => "ensino fundamental incompleto"],
        ["id" => 2, "name" => "ensino fundamental completo"],
        ["id" => 3, "name" => "ensino médio incompleto"],
        ["id" => 4, "name" => "ensino médio completo"],
        ["id" => 5, "name" => "superior incompleto"],
        ["id" => 6, "name" => "superior completo"],
        ["id" => 7, "name" => "pós graduação incompleto"],
        ["id" => 8, "name" => "pós graduação completo"],
        ["id" => 9, "name" => "mestrado incompleto"],
        ["id" => 10, "name" => "mestrado completo"],
        ["id" => 11, "name" => "doutorado incompleto"],
        ["id" => 12, "name" => "doutorado completo"],
        ["id" => 13, "name" => "não especificado"],
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $customer = new Customer();

        $this->id = $model['id cliente'];

        $customer->maintence_id              = $model['id cliente'];
        $customer->id                        = $model['id cliente'];
        $customer->name                      = $model['nome'];
        $customer->user_id                   = 1;
        $customer->broker_id                 = 1;
        $customer->cpf                       = $this->unMask($model['cpf']);
        $customer->street                    = $model['tipo logradouro'] . ' ' . $model['logradouro'];
        $customer->street_number             = $model['número'];
        $customer->complementary             = $model['complemento'];
        $customer->neighborhood              = $model['bairro'];
        $customer->city                      = $model['cidade'];
        $customer->state                     = $model['uf'];
        $customer->zipcode                   = $model['cep'];
        $customer->rg                        = $model['rg'];
        $customer->rg_issuer                 = null;
        $customer->rg_issued_at              = null;
        $customer->birthdate                 = $this->formatDate($model['data nascimento']);
        $customer->marital_status            = $this->parseMaritalStatus($model['estado civil']);
        $customer->occupation                = $model['profissão'];
        $customer->nationality               = $model['nacionalidade'];
        $customer->naturalness               = $model['naturalidade'];
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
        $customer->income                    = $model['renda'] ? $model['renda'] : null;
        $customer->bank_name                 = null;
        $customer->bank_agency               = null;
        $customer->bank_account              = null;
        $customer->children                  = (int)$model['quantidade filho'];
        $customer->autos                     = (int)$model['quantidade carro'];
        $customer->degree_level              = $this->getFromComplexConfig(strtolower($model['escolaridade']), $this->degree_levels);
        $customer->gender                    = $this->getFromComplexConfig(strtolower($model['sexo']), $this->gender);
        $customer->status                    = $this->getFromComplexConfig(strtolower($model['ativo']), $this->status);
        $customer->code                      = (int)$model['referência'];
        $customer->type                      = $this->getFromComplexConfig(strtolower($model['tipo de pessoa']), $this->type);
        $customer->cnpj                      = $model['cnpj'];
        $customer->branch_id                 = null;
        $customer->owner                     = false;
        $customer->interested                = false;
        $customer->emails                    = $this->parseEmail($model['emails']);
        $customer->phones                    = $this->parsePhone($model['telefones']);
        $customer->created_at                = $this->formatDate($model['data cadastro']);
        $customer->updated_at                = $this->formatDate($model['data atualização']);

        $customer->notes = [];
        if (!empty($model['observações'])) {
            $customer->notes[] = $model['observações'];
        }

        if (!empty($model['notas'])) {
            $customer->notes[] = $model['notas'];
        }

        return $customer;
    }

    private function parseMaritalStatus($maritalStatus)
    {
        $marital = $this->simplifyConfig($this->maritalStatus);

        if (!in_array($maritalStatus, $marital)) {
            throw new ParserException("Estado cívil inválido para o cliente {$this->id}. Estado civil informado: $maritalStatus");
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

    private function parsePhone($phones)
    {
        $parsedPhones = [];

        preg_match_all('/((Tel. Residencial:|Celular:|Tel. Comercial:) \([0-9]{2}\) [0-9]{4,5}-[0-9]{4,5})/', $phones, $matchs);

        if (empty($matchs)) {
            return;
        }

        foreach ($matchs[0] as $match) {

            list($type, $number) = explode(": ", $match);

            $cPhone        = new Phone();
            $cPhone->type  = $this->phoneTypes[$type];
            $cPhone->phone = $this->unMask($number);

            $parsedPhones[] = $cPhone;
        }

        return $parsedPhones;
    }

}
