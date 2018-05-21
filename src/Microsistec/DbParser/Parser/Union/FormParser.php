<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 04/05/18
 * Time: 19:33
 */

namespace Microsistec\DbParser\Parser\Union;


use Microsistec\DbParser\Forms;
use Microsistec\DbParser\Parser\ParserInterface;

class FormParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $form               = new Forms();
        $form->id           = (int)trim($model->pkatende);
        $form->maintence_id = (int)trim($model->pkatende);
        $form->user_id      = (int)trim($model->fkuser);
        $form->customer_id  = (int)trim($model->fkcliente);
        $form->created_at   = $this->formatDate((string)trim($model->dataate));
        $form->updated_at   = $this->formatDate((string)trim($model->dataate));
        $form->touched_at   = $this->formatDate((string)trim($model->dataate)) ?: null;
        $form->situation    = 1; //aberto
        $form->status       = 2; //interessado
        $form->broker_id    = (int)trim($model->fkcorre);
        $form->notes        = [(string)trim($model->observacli)];
        $form->source       = 'sci';

        return $form;
    }

}