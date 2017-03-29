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
    public function parse($model, $domain = "", $account = "")
    {
        $building                             = new Building();
        $building->maintence_id               = $model->id;
        $building->id                         = $model->id;
        $building->branch_id                  = $model->branch_id;
        $building->code                       = $model->code;
        $building->start_date                 = $model->start_date;
        $building->end_date                   = $model->end_date;
        $building->construction_stage         = $model->progress_percent;
        $building->website_home_highlight     = $model->website_home_highlight;
        $building->website_home_rotate_banner = $model->website_home_rotate_banner;
        $building->website_title              = $model->website_title;
        $building->website_keywords           = $model->website_keywords;
        $building->website_description        = $model->website_description;
        $building->website_notes              = $model->website_notes;
        $building->launch_status              = $model->release_status;
        $building->zipcode                    = $model->zipcode;
        $building->street                     = $model->street;
        $building->street_number              = $model->street_number;
        $building->zone                       = $model->zone;
        $building->city                       = $model->city;
        $building->neighborhood               = $model->neighborhood;
        $building->state                      = $model->state;
        $building->foundation_end             = $model->foundation_end;
        $building->foundation_percent         = $model->foundation_percent;
        $building->structure_end              = $model->structure_end;
        $building->structure_percent          = $model->structure_percent;
        $building->brickwork_end              = $model->brickwork_end;
        $building->brickwork_percent          = $model->brickwork_percent;
        $building->hydraulic_end              = $model->hydraulic_end;
        $building->hydraulic_percent          = $model->hydraulic_percent;
        $building->electric_end               = $model->electric_end;
        $building->electric_percent           = $model->electric_percent;
        $building->completion_end             = $model->completion_end;
        $building->completion_percent         = $model->completion_percent;
        $building->progress_percent           = $model->progress_percent;
        $building->name                       = $model->name;
        $building->photos                     = $model->photos;
        $building->migration_obs              = $model->migration_obs;
        $building->show_name                  = substr($model->internet_options, 0, 1);
        $building->show_price                 = substr($model->internet_options, 1, 1);
        $building->show_payment_quantities    = substr($model->internet_options, 4, 1);
        $building->show_payment_values        = substr($model->internet_options, 2, 1);
        $building->type                       = ($model->type == 0 || $model->type == 2 || $model->type == 4) ? 1 : 2;
        $building->finality                   = ($model->type == 0 || $model->type == 1 || $model->type == 2 || $model->type == 4) ? 1 : 2;
        $building->draft                      = true;
        $building->created_at                 = $model->created_at;
        $building->updated_at                 = $model->updated_at;
        $building->user_id                    = 1;
        $building->internal_notes             = $model->internal_obs;
        $building->on_duty                    = false;
        $building->work_phase                 = $model->construction_stage == 0 ? 3 : $model->construction_stage;
        $building->hotsite                    = $model->hotsite;
        $building->features                   = $this->characteristics($model);

        return $building;
    }

    private function characteristics($model)
    {
        //key = posicao do campo caracteristicas no desktop
        //value = uid na tabela features do sci online
        $characteristics = [
            "24" => '4',
            "27" => '5',
            "16" => '7',
            "12" => '12',
            "19" => '13',
            "4"  => '14',
            "13" => '23',
            "14" => '24',
            "22" => '26',
            "29" => '27',
            "28" => '56',
            "8"  => '242',
            "21" => '31',
            "17" => '41',
            "37" => '44',
            "20" => '45',
            "40" => '46',
            "39" => '',
            "26" => '50',
            "18" => '52',
            "5"  => '54',
            "34" => '57',
            "1"  => '58',
            "2"  => '60',
            "33" => '63',
            "32" => '64',
            "31" => '65',
            "15" => '66',
            "36" => '67',
            "25" => '68',
            "35" => '251',
            "11" => '71',
            "10" => '72',
            "9"  => '73',
            "30" => '74',
            "6"  => '78',
            "7"  => '79',
            "38" => '82',
            "3"  => '85',
            "23" => '86',
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

}