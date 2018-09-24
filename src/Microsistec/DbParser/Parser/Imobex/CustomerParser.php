<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 07/05/18
 * Time: 09:15
 */

namespace Microsistec\DbParser\Parser\Imobex;


use Microsistec\DbParser\Customer;
use Microsistec\DbParser\Parser\ParserInterface;

class CustomerParser extends AbstractParser implements ParserInterface
{
    private $maritalStatus = [
        1 => 2, //solteiro no imobex
        2 => 1, //casado
        3 => 5, //separado
        4 => 3, //divorciado
        5 => 4, //viuvo
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $customer = new Customer();

        $customer->id            = (int)trim($model->imovel_proprietario->linha->proprietario->linha->cd_proprietario);
        if (!$customer->id) {
            return false;
        }
        $customer->maintence_id  = (int)trim($model->imovel_proprietario->linha->proprietario->linha->cd_proprietario);
        $customer->name          = title_case((string)trim($model->imovel_proprietario->linha->proprietario->linha->nome));
        $customer->user_id       = -1;
        $customer->broker_id     = -1;
        $customer->cpf           = (string)trim($model->imovel_proprietario->linha->proprietario->linha->cpf_cnpj) ?: null;
        $customer->street        = title_case((string)trim($model->imovel_proprietario->linha->proprietario->linha->endereco)) ?: null;
        $customer->street_number = title_case((string)trim($model->imovel_proprietario->linha->proprietario->linha->numero)) ?: null;
        $customer->complementary = title_case((string)trim($model->imovel_proprietario->linha->proprietario->linha->complemento)) ?: null;

        $bairro = null;
        if ($model->imovel_proprietario->linha->proprietario->linha->bairro[1]) {
            $bairro = title_case((string)trim($model->imovel_proprietario->linha->proprietario->linha->bairro[1]->linha->nm_bairro));
        }
        $cidade = null;
        if($model->imovel_proprietario->linha->proprietario->linha->cidade[1]){
            $cidade = title_case((string)trim($model->imovel_proprietario->linha->proprietario->linha->cidade[1]->linha->nm_cidade));
        }

        $customer->neighborhood = $bairro;
        $customer->city = $cidade;

        $customer->state = null;

        if ($model->imovel_proprietario->linha->proprietario->linha->estado) {
            $customer->state = strtoupper((string)trim($model->imovel_proprietario->linha->proprietario->linha->estado->linha->sg_estado));
        }

        $customer->zipcode                   = (string)trim($model->imovel_proprietario->linha->proprietario->linha->cep) ?: null;
        $customer->rg                        = (string)trim($model->imovel_proprietario->linha->proprietario->linha->identidade) ?: null;
        $customer->rg_issuer                 = (string)trim($model->imovel_proprietario->linha->proprietario->linha->rg_orgao_exp) ?: null;
        $customer->rg_issued_at              = $this->formatDate(trim($model->imovel_proprietario->linha->proprietario->linha->rg_expedida));
        $customer->birthdate                 = $this->formatDate(trim($model->imovel_proprietario->linha->proprietario->linha->nascimento));
        $customer->marital_status            = isset($this->maritalStatus[(int)$model->imovel_proprietario->linha->proprietario->linha->cd_estado_civil]) ? $this->maritalStatus[(int)$model->imovel_proprietario->linha->proprietario->linha->cd_estado_civil] : null;
        $customer->occupation                = (string)trim($model->imovel_proprietario->linha->proprietario->linha->profissao) ?: null;
        $customer->nationality               = (string)trim($model->imovel_proprietario->linha->proprietario->linha->nacionalidade) ?: null;
        $customer->naturalness               = (string)trim($model->imovel_proprietario->linha->proprietario->linha->naturalidade) ?: null;
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
        $customer->code                      = (int)trim($model->imovel_proprietario->linha->proprietario->linha->cd_proprietario);

        $status = 1;
        if (trim((string)$model->imovel_proprietario->linha->proprietario->linha->status) == 'A') {
            $status = 1;
        } elseif (trim((string)$model->imovel_proprietario->linha->proprietario->linha->status) == 'I') {
            $status = 2;
        }

        $type = 1;
        if (trim((string)$model->imovel_proprietario->linha->proprietario->linha->tipo_pessoa) == 'F') {
            $type = 1;
        } elseif (trim((string)$model->imovel_proprietario->linha->proprietario->linha->tipo_pessoa) == 'J') {
            $type = 2;
        }

        $customer->type                      = $type;
        $customer->status                    = $status;
        $customer->cnpj                      = null;
        $customer->branch_id                 = null;
        $customer->owner                     = $this->simNaoToBool(trim((string)$model->imovel_proprietario->linha->proprietario->linha->fl_proprietario));
        $customer->interested                = $this->simNaoToBool(trim((string)$model->imovel_proprietario->linha->proprietario->linha->fl_interessado));

        $customer->phones                    = $this->parsePhones($model);
        $customer->created_at                = null;
        $customer->updated_at                = null;
        $customer->deleted_at                = null;

        $customer->notes = [];
        if (!empty(trim((string)$model->imovel_proprietario->linha->proprietario->linha->observacao))) {
            $customer->notes[] = trim((string)nl2br($model->imovel_proprietario->linha->proprietario->linha->observacao));
        }

        $customer->emails = [];
        if (!empty(trim((string)$model->imovel_proprietario->linha->proprietario->linha->email))) {
            $customer->emails[] = strtolower(trim((string)$model->imovel_proprietario->linha->proprietario->linha->email));
        }

        return $customer;
    }

    protected function parsePhones($model)
    {
        $phones    = [];
        $telefones = json_decode($model->imovel_proprietario->linha->proprietario->linha->telefones);

        if (JSON_ERROR_NONE == 0 && !empty($telefones)) {
            foreach ($telefones as $telefone) {

                $phone        = new \stdClass();
                if (strpos(trim($telefone->ds_contato), '*') === false) {
                    $phone->phone = $this->unMask(trim($telefone->ds_contato));
                } else {
                    $phone->phone = trim($telefone->ds_contato);
                }

                $phones[]     = $phone;
            }
        }

        return $phones;
    }

}