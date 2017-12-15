<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 20/12/16
 * Time: 17:28
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\Building;
use Microsistec\DbParser\Exceptions\FormatterException;
use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\Formatter;
use Microsistec\DbParser\ZipCodeService;

class BuildingParser extends AbstractParser
{
    protected $id;

    protected $possibilities = [
        'Casas residenciais'                                                                           => ['type' => 1, "finality" => 1],
        'Casas residenciais, Chácaras'                                                                 => ['type' => 1, "finality" => 1],
        'Casas residenciais, Terrenos ou lotes residenciais, Terrenos ou lotes comerciais, Industrial' => ['type' => 1, "finality" => 1],
        'Casas residenciais, Terrenos ou lotes residenciais'                                           => ['type' => 1, 'finality' => 1],
        'Casas residenciais, Terrenos ou lotes residenciais, Prédios residenciais'                     => ['type' => 1, 'finality' => 1],
        'Casas residenciais, Prédios residenciais'                                                     => ['type' => 1, 'finality' => 1],
        'Prédios residenciais'                                                                         => ['type' => 2, 'finality' => 1],
        'Edifício Comercial'                                                                           => ['type' => 2, 'finality' => 2],
        'Terrenos ou lotes residenciais'                                                               => ['type' => 1, 'finality' => 1],
        'Galpões Comerciais'                                                                           => ['type' => 1, 'finality' => 2],
        'Industrial'                                                                                   => ['type' => 1, 'finality' => 3],
        'Chácaras'                                                                                     => ['type' => 1, 'finality' => 4],
        'Edifício Residencial'                                                                         => ['type' => 2, 'finality' => 1],
        'Edifício Residencial, Edifício Comercial'                                                     => ['type' => 2, 'finality' => 1],
        'Galpões Comerciais, Industrial'                                                               => ['type' => 1, 'finality' => 2],
        'Galpões Comerciais, Industrial, Prédios comerciais'                                           => ['type' => 1, 'finality' => 2],
        'Prédios comerciais'                                                                           => ['type' => 2, 'finality' => 2],
    ];

    protected $status = [
        "pronto"        => 2,
        "em construção" => 1,
    ];

    protected $salesSystem = [
        "preço fechado"  => 1,
        "preço de custo" => 2,
    ];

    protected $workPhase = [
        'pronto'        => 1,
        'em construção' => 2,
        'não iniciado'  => 3,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        if (!empty($model['id empreendimento pai'])) {
            return false;
        }

        $this->id = $model['id empreendimento'];

        $building                             = new Building();
        $building->id                         = $model['id empreendimento'];
        $building->maintence_id               = $model['id empreendimento'];
        $building->code                       = $model['id empreendimento'];
        $building->alternative_code           = null;
        $building->construction_stage         = null;
        $building->start_date                 = null;
        $building->end_date                   = $this->formatDate($model['data entrega']) ?: null;
        $building->website_home_highlight     = $this->simNaoToBool($model['destaque']);
        $building->website_home_rotate_banner = false;
        $building->website_title              = null;
        $building->website_keywords           = null;
        $building->website_description        = null;
        $building->website_notes              = null;
        $building->zipcode                    = $this->unMask($model['cep']);
        $building->street                     = trim($model['tipo logradouro'] . ' ' . $model['logradouro']);
        $building->street_number              = $model['número'];
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
        $building->name                       = trim($model['nome']);
        $building->show_name                  = false; // Acho melhor por padrão não mostrar o nome
        $building->show_price                 = false; // Acho melhor por padrão não mostrar o valor
        $building->show_rent_price            = false; // Acho melhor por padrão não mostrar o valor de locacao
        $building->show_payment_quantities    = true; // Quantidade de parcelas naum tem problema
        $building->show_payment_values        = true; // Valor das parcelas naum tem problema
        $type                                 = $this->parseTipo($model['tipo']);
        $building->type                       = $type['type'];
        $building->finality                   = $type['finality'];
        $building->draft                      = false;
        $building->hotsite                    = $model['site'];
        $building->on_duty                    = $this->simNaoToBool($model['plantão']);
        $building->work_phase                 = null;
        $building->user_id                    = $model['id usuario cadastro'];
        $building->branch_id                  = null; //não tem campo que indique essa informação
        $building->created_at                 = null; //não tem campo que indique essa informação
        $building->updated_at                 = null; //não tem campo que indique essa informação
        $building->deleted_at                 = null; //não tem campo que indique essa informação
        $building->photos                     = null; //é preenchida posteriormente
        $building->features                   = null; //é preenchida posteriormente
        $building->internal_notes             = $model['descrição'];
        $building->neighborhood               = $model['bairro'];
        $building->city                       = isset($model['cidade']) ? $model['cidade'] : null;
        $building->state                      = $model['estado'];
        $building->publish                    = $this->simNaoToBool($model['publicar']);
        $building->general_status             = $this->parseStatus($model['fase']);

        return $building;
    }

    protected function parseTipo($string)
    {
        if (!isset($this->possibilities[$string])) {
            throw new ParserException("No Emprendimento {$this->id} o tipo do empreendimento enviado é inválido. Tipo enviado: " . $string);
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

    public function parseSalesSystem($salesSystem)
    {
        $salesSystem = strtolower($salesSystem);

        if (!isset($this->salesSystem[$salesSystem])) {
            return 1;
        }

        return $this->salesSystem[$salesSystem];
    }

}
