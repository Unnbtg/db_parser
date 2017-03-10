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
        ['id' => 1, 'name' => 'casado'],
        ['id' => 2, 'name' => 'solteiro'],
        ['id' => 3, 'name' => 'divorciado'],
        ['id' => 4, 'name' => 'viúvo'],
        ['id' => 5, 'name' => 'separado'],
        ['id' => 6, 'name' => 'união estável'],
        ['id' => 0, 'name' => 'não informado']
    ];

    protected $status = [
        ['id' => 1, 'name' => 'sim'],
        ['id' => 2, 'name' => 'nao'],
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

        $this->id = $customer->maintence_id = $customer->id = $model['id cliente'];
        $customer->code = $model['referência'];
        $customer->name = $model['nome'];
        $customer->email = $this->parseEmail($model['emails']);
        $customer->phone = $this->parsePhone($model['telefones']);
        $customer->status = $this->getFromComplexConfig(strtolower($model['ativo']), $this->status);
        $customer->created_at = $model['data cadastro'];

        $customer->notes = [];
        if (!empty($model['observações'])) {
            $customer->notes[] = $this->createCustomerNote($model['observações']);
        }

        $customer->birthdate = $model['data nascimento'];
        $customer->gender = $this->getFromComplexConfig(strtolower($model['sexo']), $this->gender);
        $customer->type = $this->getFromComplexConfig(strtolower($model['tipo de pessoa']), $this->type);
        $customer->rg = $model['rg'];
        $customer->cpf = $model['cpf'];

        $customer->notes = [];

        if (!empty($model['notas'])) {
            $customer->notes[] = $this->createCustomerNote($model['notas']);
        }

        $customer->nationality = $model['nacionalidade'];
        $customer->naturalness = $model['naturalidade'];

        $customer->branch = $model['ramo atuação'];

        $customer->occupation = $model['profissão'];

        $customer->external_source = $model['midia origem'];

        $customer->marital_status = $this->parseMaritalStatus($model['estado civil']);
        $customer->children = $model['quantidade filho'];
        $customer->autos = $model['quantidade carro'];
        $customer->income = $model['renda'];
        $customer->degree_level = $this->getFromComplexConfig(strtolower($model['escolaridade']), $this->degree_levels);
        $customer->customer_attorney = $this->getFromComplexConfig(strtolower($model['procurador']), $this->attorney);

        $customer->zipcode = $model['cep'];
        $customer->street = $model['tipo logradouro'] . ' ' . $model['logradouro'];
        $customer->street_number = $model['número'];
        $customer->complementary = $model['complemento'];

        if (!empty($model['cep'])) {
            $address = new ZipCodeService();
            $cep = $address->getAddress($model['cep']);
            $customer->neighborhood_id = $cep['id_bairro'];
            $customer->city_id = $cep['id_cidade'];
            $customer->state_id = $cep['id_uf'];
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

        return array_map([$this, 'createEmail'], $email);
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
            $cPhone = new Phone();
            $cPhone->type = $this->phoneTypes[$type];
            $cPhone->phone = $number;

            $parsedPhones[] = $cPhone;
        }
        return $parsedPhones;
    }

    private function createCustomerNote($note)
    {
        $cNote = new CustomerNote();

        $cNote->body = $note;

        return $cNote;
    }

    private function parseMaritalStatus($maritalStatus)
    {
        $marital = $this->simplifyConfig($this->maritalStatus);
        if (!in_array($maritalStatus, $marital)) {
            throw new ParserException("Estado cívil inválido para o cliente {$this->id}. Estado civil informado: $maritalStatus");
        }

        return $marital[$maritalStatus];
    }

    private function createEmail($email)
    {
        $cEmail = new CustomerEmail();
        $cEmail->default = 1;
        $cEmail->name = "Padrão";
        $cEmail->email = trim($email);
        return $cEmail;
    }

}
