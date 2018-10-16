<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 20/03/17
 * Time: 14:26
 */

namespace Microsistec\DbParser\Parser\Desktop;


use Microsistec\DbParser\Forms;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Apartment;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Commercial;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\House;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Land;
use Microsistec\DbParser\Parser\Desktop\PropertyTypes\Rural;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;

class FormParser extends ParserAbstract implements ParserInterface
{

    public function parse($model, $domain = "", $account = "")
    {
        $types = null;

        if(!is_null($model->property_type)) {
            $typeInstance = $this->getInstanceByType($model);
            if (!is_null($typeInstance)) {
                $types = $typeInstance->getTypeSubtype($model);
            }
        }

        $form                    = new Forms();
        $form->maintence_id      = $model->id;
        $form->id                = $model->id;
        $form->status            = 2; //interessado
        $form->source            = 'sci';
        $form->user_id           = $model->broker_id;

        if ($model->status == 0 || $model->status == 2) { //Ativa no desktop ou em negociacao
            $form->situation = 1; //Aberta no online
        }

        $form->customer_id       = $model->customer_id;

        $form->profile = new \stdClass();

        $form->profile->property_city     = null;
        $form->profile->neighborhoods     = [];
        $form->profile->dorm_count        = (int)$model->property_dorm;
        $form->profile->for_sale          = $model->property_finality == 0 ? true : false;
        $form->profile->for_rent          = $model->property_finality == 1 ? true : false;
        $form->profile->max_value         = null;
        if(!empty($model->property_max_value)) {
            $form->profile->max_value         = str_replace(',', '.', $model->property_max_value);
        }
        $form->profile->parking_lot_count = (int)$model->property_parking_lots;
        $form->profile->suit_count        = (int)$model->property_suite;
        $form->profile->types             = !is_null($types) ? [(int)$types['tipo']] : [];

        $form->notes = [];
        if(!empty($model->note)){
            $form->notes[] = $model->note;
        }
        if(!empty($model->property_city)){
            $form->notes[] = 'Cidade desejada: ' . $model->property_city;
        }
        if(!empty($model->property_neighborhoods[0])){
            $form->notes[] = 'Bairro(s) desejado(s): ' . implode(', ', $model->property_neighborhoods);
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

        if ($model->status == 1) { //se for inativa exclui, thiago que decidiu
            $form->deleted_at = date('Y-m-d H:i:s');
        }

        return $form;
    }

    private function getInstanceByType($model)
    {
        $instance = null;

        switch ($model->property_type) {
            case 0:
                $instance = new House();
                break;
            case 1:
                $instance = new Apartment();
                break;
            case 2:
                $instance = new Land();
                break;
            case 4:
                $instance = new Commercial();
                break;
            case 5:
                $instance = new Rural();
                break;
        }

        return $instance;
    }
}