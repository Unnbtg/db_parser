<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 22/12/16
 * Time: 12:25
 */

namespace Microsistec\DbParser\Parser\IValue;

use Microsistec\DbParser\Forms;

class FormParser extends AbstractParser
{
    protected $status = [
        ['id' => 1, 'name' => 'em atendimento'],
        ['id' => 2, 'name' => 'finalizado'],

    ];

    public function parse($model, $domain = "", $account = "")
    {
        $form = new Forms();
        $form->maintence_id = $model['id atendimento'];
        $form->created_at = $model['data cadastro'];
        $form->updated_at = $model['data atualizacao'];
        $form->treated_at = $model['data atendimento'];
        $form->comment = $model['comentario'];
        $form->situation = $this->getFromComplexConfig(strtolower($model['status']), $this->status);
        $form->customer_id = $model['id cliente'];
        $form->user_id = $model['id usuario'];

        return $form;
    }
}