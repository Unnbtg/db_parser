<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 20/03/17
 * Time: 12:24
 */

namespace Microsistec\DbParser\Parser\Desktop;


use Microsistec\DbParser\Building;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class BuildingParser extends ParserAbstract implements ParserInterface
{
    protected $zones = [
        0 => 'Indefinida',
        1 => 'Norte',
        2 => 'Sul',
        3 => 'Leste',
        4 => 'Oeste',
        5 => 'Centro',
        6 => 'Grande São Paulo',
        7 => 'Litoral',
        8 => 'Interior',
        9 => 'ABC',
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $building                             = new Building();
        $building->maintence_id               = (int)$model->id;
        $building->id                         = (int)$model->id;
        $building->branch_id                  = (int)$model->branch_id;
        $building->code                       = (int)$model->code;
        $building->start_date                 = $this->formatDate($model->start_date);
        $building->end_date                   = $this->formatDate($model->end_date);
        $building->website_home_highlight     = (bool)$model->website_home_highlight;
        $building->website_home_rotate_banner = (bool)$model->website_home_rotate_banner;
        $building->highlight_photo            = $model->highlight_photo;
        $building->website_title              = $model->website_title;
        $building->website_keywords           = $model->website_keywords;
        $building->website_description        = $model->website_description;
        $building->website_notes              = $model->website_notes;

        $building->zipcode                    = $this->unMask($model->zipcode);
        $building->street                     = $model->street;
        $building->street_number              = $model->street_number;
        $building->zone                       = $model->zone;
        $building->city                       = $model->city;
        $building->neighborhood               = $model->neighborhood;
        $building->state                      = $this->getState($model->state);
        $building->foundation_end             = $this->formatDate($model->foundation_end);
        $building->foundation_percent         = (int)$model->foundation_percent;
        $building->structure_end              = $this->formatDate($model->structure_end);
        $building->structure_percent          = (int)$model->structure_percent;
        $building->brickwork_end              = $this->formatDate($model->brickwork_end);
        $building->brickwork_percent          = (int)$model->brickwork_percent;
        $building->hydraulic_end              = $this->formatDate($model->hydraulic_end);
        $building->hydraulic_percent          = (int)$model->hydraulic_percent;
        $building->electric_end               = $this->formatDate($model->electric_end);
        $building->electric_percent           = (int)$model->electric_percent;
        $building->completion_end             = $this->formatDate($model->completion_end);
        $building->completion_percent         = (int)$model->completion_percent;
        $building->progress_percent           = (int)$model->progress_percent;
        $building->name                       = $model->name;
        $building->photos                     = $model->photos;
        $building->migration_obs              = $model->migration_obs;
        $building->show_name                  = (bool)substr($model->internet_options, 0, 1);
        $building->show_payment_quantities    = (bool)substr($model->internet_options, 4, 1);
        $building->show_payment_values        = (bool)substr($model->internet_options, 2, 1);
        $building->show_price                 = (bool)substr($model->internet_options, 1, 1);
        $building->publish                    = (bool)substr($model->internet_options, 7, 1);
        $building->type                       = ($model->type == 0 || $model->type == 2 || $model->type == 4) ? 1 : 2;
        $building->finality                   = ($model->type == 3) ? 2 : 1;
        $building->draft                      = false;
        $building->created_at                 = $this->formatDate($model->created_at);
        $building->updated_at                 = $this->formatDate($model->updated_at);
        $building->deleted_at                 = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;
        $building->user_id                    = 1;
        $building->internal_notes             = $model->internal_obs;
        $building->on_duty                    = false;
        $building->videos                     = $model->videos;
        $building->contacts                   = $model->contacts;
        $building->for_rent                   = $model->for_rent;
        $building->owners                     = [(int)$model->owner_id];

        $building->prevision_date             = $this->formatDate($model->prevision_date);

        $building->work_phase = null;
        $building->launch_status = null;

        if ($model->release_status == 1) { //Lancamento
            $building->launch_status = 3;
        }
        if ($model->construction_stage == 0) { //Pré lancamento
            $building->launch_status = 2;
        }
        if ($model->construction_stage == 1) { //Em obras
            $building->work_phase = 1;
        }
        if ($model->construction_stage == 2) { //Pronto
            $building->launch_status = 4;
            $building->work_phase = 2;
        }

        if ($model->construction_stage == 3) { //Esgotado
            $building->launch_status = 7;
        }

        if($model->resale) {
            $building->launch_status = 6;
        }

        foreach (str_split($model->characteristics) as $key => $value) {
            if($key == 38 && $value == 1) {
                $building->accept_mcmv = 1;
            }
        }

        $building->zone                       = $this->getZone($model->zone);
        $building->hotsite                    = $model->hotsite;
        $building->features                   = $this->characteristics($model);

        $encodedBuilding = new Building();

        foreach ($building as $key => $value) {

            $encodedBuilding->{$key} = $value !== '' ? $value : null;

            if (!empty($value) && is_string($value)) {
                $encodedBuilding->{$key} = utf8_encode(utf8_decode($value));
            }

        }

        return $encodedBuilding;
    }

    private function characteristics($model)
    {
        //key = posicao do campo caracteristicas no desktop
        //value = uid na tabela features do sci online
        $characteristics = [
            "24" => 4,
            "27" => 5,
            "16" => 7,
            "12" => 12,
            "19" => 13,
            "4"  => 14,
            "13" => 23,
            "14" => 24,
            "22" => 26,
            "29" => 27,
            "28" => 56,
            "8"  => 302,
            "21" => 31,
            "17" => 41,
            "37" => 44,
            "20" => 45,
            "40" => 46,
            //"39" => '',
            "26" => 50,
            "18" => 52,
            "5"  => 54,
            "34" => 57,
            "1"  => 58,
            "2"  => 60,
            "33" => 63,
            "32" => 64,
            "31" => 65,
            "15" => 66,
            "36" => 67,
            "25" => 68,
            "35" => 251,
            "11" => 71,
            "10" => 72,
            "9"  => 73,
            "30" => 74,
            "6"  => 78,
            "7"  => 79,
            "38" => 82,
            "3"  => 85,
            "23" => 86,
        ];

        $newCharacteristics = [];

        foreach (str_split($model->characteristics) as $key => $value) {
            if($value != 1 || empty($characteristics[$key+1]) ){
                continue;
            }
            $newCharacteristics[] = $characteristics[$key+1];
        }

        return $newCharacteristics;

    }

    protected function getZone($zone)
    {
        if (!empty($zone) && !is_null($zone)) {
            return $this->zones[$zone];
        }

        return null;
    }

}