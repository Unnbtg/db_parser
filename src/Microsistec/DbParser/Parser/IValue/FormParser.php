<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 22/12/16
 * Time: 12:25
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\Forms;
use Microsistec\DbParser\Property;

class FormParser extends AbstractParser
{
    public function parse($model, $domain = "", $account = "")
    {
        $form = new Forms();
        $form->user_id = $model['id usuario'];
        $form->created_at = $model['data cadastro'];
        $form->updated_at = $model['data atualizacao'];
        $form->treated_at = $model['data atendimento'];
        $form->comment = $model['comentario'];
        $form->status = $model['status'];
        $form->customer_id = $model['id cliente'];
        $form->id = $model['id atendimento'];

        return $form;


    }


}