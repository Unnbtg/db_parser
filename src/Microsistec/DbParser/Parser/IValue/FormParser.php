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
        $form               = new Forms();
        $form->id           = $model['id atendimento'];
        $form->maintence_id = $model['id atendimento'];
        $form->user_id      = $model['id usuario cadastro'];
        $form->customer_id  = $model['id cliente'];
        $form->created_at   = $this->formatDate($model['data cadastro']);
        $form->updated_at   = $this->formatDate($model['data atualizacao']);
        $form->touched_at   = $this->formatDate($model['data atendimento']) ?: null;
        $form->situation    = $this->getFromComplexConfig(strtolower($model['status']), $this->status);
        $form->status       = 2; //interessado
        $form->broker_id    = $model['id usuario'];
        $form->notes        = [$model['comentario']];
        $form->source       = 'sci';

        return $form;
    }
}