<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 07/05/18
 * Time: 11:10
 */

namespace Microsistec\DbParser\Parser\Union;


use Microsistec\DbParser\Building;
use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\Parser\ParserInterface;

class BuildingParser extends AbstractParser implements ParserInterface
{
    protected $id;

    protected $possibilities = [
        196430 => ['type' => 2, 'finality' => 1],
        196443 => ['type' => 1, "finality" => 1],
        196431 => ['type' => 1, "finality" => 1],
        196439 => ['type' => 1, "finality" => 1],
        196441 => ['type' => 1, "finality" => 1],
        196440 => ['type' => 1, "finality" => 1],
        196432 => ['type' => 1, "finality" => 1],
        196435 => ['type' => 1, 'finality' => 2],
        196438 => ['type' => 1, 'finality' => 3],
        196433 => ['type' => 1, 'finality' => 3],
        196434 => ['type' => 1, 'finality' => 2],
        196437 => ['type' => 1, 'finality' => 2],
        196436 => ['type' => 1, 'finality' => 2],
        196442 => ['type' => 2, 'finality' => 2],
        56134 => ['type' => 2, 'finality' => 1],
    ];

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
        $this->id = (int)trim($model->pkcadempre);

        $building                             = new Building();
        $building->id                         = (int)trim($model->pkcadempre);
        $building->maintence_id               = (int)trim($model->pkcadempre);
        $building->code                       = (int)trim($model->pkcadempre);
        $building->alternative_code           = null;
        $building->construction_stage         = null;
        $building->start_date                 = null;
        $building->end_date                   = $this->formatDate(trim($model->dataent)) ?: null;
        $building->website_home_highlight     = (bool)trim($model->pub_destaque);
        $building->website_home_rotate_banner = false;
        $building->website_title              = null;
        $building->website_keywords           = null;
        $building->website_description        = null;
        $building->website_notes              = (string)trim($model->inf_descricaores);
        $building->zipcode                    = $this->unMask((string)trim($model->cep));
        $building->street                     = (string)trim($model->endereco);
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
        $type                                 = $this->parseTipo((int)trim($model->tipo));
        if (!$type) {
            return false;
        }
        $building->type                       = $type['type'];
        $building->finality                   = $type['finality'];
        $building->draft                      = false;
        $building->hotsite                    = (string)trim($model->inf_site);
        $building->on_duty                    = false;
        $building->work_phase                 = null;
        $building->user_id                    = 1;
        $building->branch_id                  = null;
        $building->created_at                 = null;
        $building->updated_at                 = null;
        $building->deleted_at                 = null;
        $building->photos                     = null; //é preenchida posteriormente
        $building->features                   = null; //é preenchida posteriormente
        $building->internal_notes             = (string)trim($model->inf_descricao);
        $building->neighborhood               = (string)trim($model->bairro);
        $building->city                       = (string)trim($model->cidade);
        $building->state                      = (string)trim($model->estado);
        $building->publish                    = true;
        $building->general_status             = $this->parseStatus((int)trim($model->fase));
        $building->features                   = $this->addFeatures($model);

        return $building;
    }

    protected function parseTipo($string)
    {
        if (!isset($this->possibilities[$string])) {
            \Log::error("No Emprendimento {$this->id} o tipo do empreendimento enviado é inválido. Tipo enviado: " . $string);
            return false;
        }

        return $this->possibilities[$string];
    }

    public function parseStatus($status)
    {
        $status = strtolower($status);

        if (!isset($this->status[$status])) {
            return 1;
        }

        return $this->status[$status];
    }

    private function addFeatures($model)
    {
        $characteristics = [];

        $chars = [
            'det_academia'      => 267,
            'det_playground'    => 66,
            'det_quadrasquash'  => 300,
            'det_quadratenis'   => 71,
            'det_frentemar'     => 30,
            'det_salaofesta'    => 78,
            'det_salaofestainf' => 78,
            'det_piscinfantil'  => 62,
            'det_piscaquecida'  => 60,
            'det_salaginastica' => 77,
            'det_salaojogos'    => 79,
            'det_sauna'         => 80,
            'det_pomar'         => 67,
            'det_spa'           => 86,
            'det_brinquedoteca' => 7,
            'det_fornopp'       => 29,
            'det_espmulher'     => 26,
            'det_vestiario'     => 172,
            'det_solarium'      => 85,
            'det_fitness'       => 302,
            'det_dog'           => 57,
            'det_churrasqueira' => 12,
            'det_quadrapoli'    => 73,
            'det_piscina'       => 58,
            'det_cercaelet'     => 266,
            'det_lago'          => 44,
            'det_praca'         => 251,
            'det_heliporto'     => 201,
            'det_saunaseca'     => 243,
            'det_campogolf'     => 292,
            'det_ofuro'         => 297,
            'det_lanhouse'      => 45,
            'det_bocha'         => 63,
            'det_cinema'        => 13,
            'det_alarmemoni'    => 2,
            'det_deposito'      => 253,
            'det_edicula'       => 304,
            'det_gascentral'    => 10,
            'det_interfone'     => 43,
            'det_portaoelet'    => 69,
            'det_portaria'      => 70,
            'det_portaria24h'   => 319,
            'det_seguranca'     => 123,
            'det_terraco'       => 88,
            'det_zelador'       => 171,
            'det_elevador'      => 20,
            'det_elevadorserv'  => 19,
            'det_elevadorsoc'   => 20,
            'det_jardim'        => 134,
            'det_campofutebol'  => 9,
        ];

        foreach ($chars as $key => $value) {

            if (property_exists($model, $key)) {
                if ($this->simNaoToBool($this->booleanValue($model->$key))) {
                    $characteristics[] = $value;
                }
            }
        }

        return !empty($characteristics) ? array_values(array_filter($characteristics)) : $characteristics;
    }
}