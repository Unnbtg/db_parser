<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 07/05/18
 * Time: 11:10
 */

namespace Microsistec\DbParser\Parser\Plug7;


use Microsistec\DbParser\Building;
use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\Parser\ParserInterface;

class BuildingParser extends AbstractParser implements ParserInterface
{

    protected $status = [
        0  => 1,
        1  => 2,
        3  => 8,
        4  => 8,
        5  => 8,
        6  => 8,
        7  => 8,
        8  => 4,
        10 => 3,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $building                             = new Building();
        $building->id                         = (int)trim($model->id);
        $building->maintence_id               = (int)trim($model->id);
        $building->code                       = (int)trim($model->id);
        $building->alternative_code           = null;
        $building->construction_stage         = null;
        $building->start_date                 = null;
        $building->end_date                   = null;
        $building->website_home_highlight     = false;
        $building->website_home_rotate_banner = false;
        $building->website_title              = null;
        $building->website_keywords           = null;
        $building->website_description        = null;
        $building->website_notes              = null;
        $building->zipcode                    = $this->unMask((string)trim($model->cep));
        $building->street                     = (string)trim($model->logradouro);
        $building->street_number              = (string)trim($model->numero);
        $building->city_id                    = null;
        $building->neighborhood_id            = null;
        $building->zone                       = null;
        $building->launch_status              = null;
        $building->structure_start            = null;
        $building->structure_end              = null;
        $building->structure_percent          = null;
        $building->foundation_start           = null;
        $building->foundation_end             = null;
        $building->foundation_percent         = null;
        $building->brickwork_start            = null;
        $building->brickwork_end              = null;
        $building->brickwork_percent          = null;
        $building->hydraulic_start            = null;
        $building->hydraulic_end              = null;
        $building->hydraulic_percent          = null;
        $building->electric_start             = null;
        $building->electric_end               = null;
        $building->electric_percent           = null;
        $building->completion_start           = null;
        $building->completion_end             = null;
        $building->completion_percent         = null;
        $building->progress_percent           = null;
        $building->name                       = trim((string)$model->nome);
        $building->show_name                  = false; // Acho melhor por padrão não mostrar o nome
        $building->show_price                 = false; // Acho melhor por padrão não mostrar o valor
        $building->show_rent_price            = false; // Acho melhor por padrão não mostrar o valor de locacao
        $building->show_payment_quantities    = true; // Quantidade de parcelas naum tem problema
        $building->show_payment_values        = true; // Valor das parcelas naum tem problema

        $building->type                       = 2;
        $building->finality                   = 1;
        $building->draft                      = false;
        $building->hotsite                    = null;
        $building->on_duty                    = false;
        $building->work_phase                 = null;
        $building->user_id                    = 1;
        $building->branch_id                  = null;
        $building->created_at                 = null;
        $building->updated_at                 = null;
        $building->deleted_at                 = null;
        $building->photos                     = null; //é preenchida posteriormente
        $building->features                   = null; //é preenchida posteriormente
        $building->internal_notes             = null;
        $building->neighborhood               = (string)trim($model->bairro);
        $building->city                       = (string)trim($model->cidade);
        $building->state                      = (string)trim($model->estado);
        $building->publish                    = true;
        $building->general_status             = null;
        $building->features                   = [];

        return $building;
    }

}