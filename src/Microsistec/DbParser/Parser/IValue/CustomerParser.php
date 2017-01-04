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
use Microsistec\DbParser\Phone;
use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\ZipCodeService;

class CustomerParser extends AbstractParser
{
    protected $id;

    protected $phoneTypes = [
        "Tel. Residencial" => "home",
        "Tel. Comercial" => 'work',
        "Celular" => 'mobile',
    ];

    protected $maritalStatus = [
        ['id' => 1, 'name' => 'Casado'],
        ['id' => 2, 'name' => 'Solteiro'],
        ['id' => 3, 'name' => 'Divorciado'],
        ['id' => 4, 'name' => 'Viúvo'],
        ['id' => 5, 'name' => 'Separado'],
        ['id' => 6, 'name' => 'União Estável'],
        ['id' => 0, 'name' => 'Não informado']
    ];


    public function parse($model, $domain = "", $account = "")
    {
        $customer = new Customer();

        $this->id = $customer->maintence_id = $customer->id = $model['id cliente'];
        $customer->name = $model['nome'];
        $customer->email = $this->parseEmail($model['emails']);
        $customer->phone = $this->parsePhone($model['telefones']);
        $customer->notes = [];
        if (!empty($model['observações'])) {
            $customer->notes[] = $this->createCustomerNote($model['observações']);
        }

        if (!empty($model['notas'])) {
            $customer->notes[] = $this->createCustomerNote($model['notas']);
        }

        $customer->birthdate = $model['data nascimento'];
        $customer->rg = $model['rg'];
        $customer->cpf = $model['cpf'];
        $customer->rg_issued_at = $model['inscrição estadual'];
        $customer->naturalness = $model['naturalidade'];
        $customer->nationality = $model['nacionalidade'];
        $customer->marital_status = $this->parseMaritalStatus($model['estado civil']);
        $customer->income = $model['renda'];

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

    private function parseMaritalStatus($maritalStatus) {
        $marital = $this->simplifyConfig($this->maritalStatus);
        if (! in_array($maritalStatus,$marital)) {
            throw new ParserException("Estado cívil inválido para o cliente {$this->id}. Estado civil informado: $maritalStatus");
        }

        return $marital[$maritalStatus];
    }

    private function parseEmail($email) {
        if (empty($email)) {
            return [];
        }

        $email = array_map('trim',explode(',', $email));
        $email = is_array($email) ? $email : [$email];

        return array_map([$this,'createEmail'], $email);
    }

    private function createEmail($email)
    {
        $cEmail = new CustomerEmail();
        $cEmail->default = 1;
        $cEmail->name = "Padrão";
        $cEmail->email = trim($email);
        return $cEmail;
    }

    private function parsePhone($phones) {
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


    private function createCustomerNote($note) {
        $cNote = new CustomerNote();

        $cNote->body = $note;

        return $cNote;
    }


}