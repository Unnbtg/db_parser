<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 20/03/17
 * Time: 14:26
 */

namespace Microsistec\DbParser\Parser\Desktop;


use Microsistec\DbParser\Forms;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;

class FormParser extends ParserAbstract implements ParserInterface
{

    public function parse($model, $domain = "", $account = "")
    {
        $form              = new Forms();
        $form->id          = $model->id;
        $form->status      = $model->status;
        $form->source      = 'sci';
        $form->situation   = 1;
        $form->customer_id = $model->customer_id;
        $form->created_at  = $model->created_at;
        $form->updated_at  = $model->updated_at;
    }
}