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
        $form                    = new Forms();
        $form->maintence_id      = $model->id;
        $form->id                = $model->id;
        $form->status            = $model->status;
        $form->source            = 'sci';
        $form->situation         = 1;
        $form->customer_id       = $model->customer_id;
        $form->property_type     = $model->property_type;
        $form->property_finality = $model->property_finality;
        $form->property_city     = $model->property_city;

        if (is_array($model->property_neighborhoods)) {
            $form->property_neighborhoods[] = $model->property_neighborhoods;
        } else {
            $form->property_neighborhoods = $model->property_neighborhoods;
        }

        $form->property_parking_lots   = $model->property_parking_lots;
        $form->property_max_value      = $model->property_max_value;
        $form->property_dorm           = $model->property_dorm;
        $form->property_suite          = $model->property_suite;
        $form->note                    = $model->note;
        $form->note_broker_client      = $model->note_broker_client;
        $form->note_broker_negotiation = $model->note_broker_negotiation;
        $form->created_at = $this->formatDate($model->created_at);
        $form->updated_at = $this->formatDate($model->updated_at);
        $form->deleted_at = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;

        return $form;
    }
}