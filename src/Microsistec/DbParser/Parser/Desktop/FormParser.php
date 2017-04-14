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

        $form->profile = new \stdClass();

        $form->profile->property_city     = $model->property_city;
        $form->profile->dorm_count        = (int)$model->property_dorm;
        $form->profile->for_sale          = $model->property_finality == 0 ? true : false;
        $form->profile->for_rent          = $model->property_finality == 1 ? true : false;
        $form->profile->max_value         = null;
        if(!empty($model->property_max_value)) {
            $form->profile->max_value         = str_replace(',', '.', $model->property_max_value);
        }
        $form->profile->neighborhoods     = [$model->property_neighborhoods];
        $form->profile->parking_lot_count = (int)$model->property_parking_lots;
        $form->profile->suit_count        = (int)$model->property_suite;
        $form->profile->types             = !is_null($model->property_type) ? [$model->property_type] : [];

        $form->notes = [];
        if(!empty($model->note)){
            $form->notes[] = $model->note;
        }
        if(!empty($model->note_broker_client)){
            $form->notes[] = $model->note_broker_client;
        }
        if(!empty($model->note_broker_negotiation)){
            $form->notes[] = $model->note_broker_negotiation;
        }

        $form->created_at = $this->formatDate($model->created_at);
        $form->updated_at = $this->formatDate($model->updated_at);
        $form->deleted_at = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;

        return $form;
    }
}