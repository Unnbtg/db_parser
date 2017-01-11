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
        'Casas residenciais' => ['type' => 1, "finality" => 1], // Tipo 1 Finalidade 1
        'Casas residenciais, Terrenos ou lotes residenciais, Terrenos ou lotes comerciais, Industrial' => ['type' => 1, "finality" => 1], // Tipo 1 Finalidade 1
        'Casas residenciais, Terrenos ou lotes residenciais' => ['type' => 1, 'finality' => 1],// Tipo 1 Finalidade 1
        'Casas residenciais, Prédios residenciais' => ['type' => 1, 'finality' => 1],// Tipo 1 Finalidade 1
        'Prédios residenciais' => ['type' => 2, 'finality' => 1],// Tipo 1 Finalidade 1
        'Edifício Comercial' => ['type' => 1, 'finality' => 2], // Tipo 1 Finalidade 2
        'Terrenos ou lotes residenciais' => ['type' => 2, 'finality' => 1], // Tipo 2 Finalidade 1
        'Galpões Comerciais' => ['type' => 3, 'finality' => 2], // Tipo 3 Finalidade 2
        'Industrial' => ['type' => 3, 'finality' => 2] // Tipo 3 Finlidade 2
    ];

    protected $status = [
        "pronto" => 2,
        "em construção" => 1
    ];

    public function parse($model, $domain = "", $account = "")
    {
        try {

            $zipService = new ZipCodeService();
            $building = new Building();

            if (!empty($model['id empreendimento pai'])) {
                return false;
            }

            $this->id = $building->code = $model['id empreendimento'];
            $building->maintence_id = $model['id empreendimento'];

            $building->name = $model['nome'];
            $type = $this->parseTipo($model['tipo']);

            $building->type = $type['type'];
            $building->finality = $type['finality'];
            $building->street = trim($model['tipo logradouro'] . ' ' . $model['logradouro']);
            $building->street_number = $model['número'];

            $building->zipcode = Formatter::zipcode($model['cep']);
            $address = $zipService->getAddress($model['cep']);
            $building->neighborhood_id = $address['id_bairro'] !== null ? $address['id_bairro'] : 0 ;
            $building->city_id = $address['id_cidade'] !== null ? $address['id_cidade'] : 0 ;
            $building->state_id = $this->getState($address['id_uf']);

            $building->observation = $model['descrição'];
            $building->publish = $this->simNaoToBool($model['publicar']);
            $building->website_home_highlight = $this->simNaoToBool($model['destaque']);
            $building->status = $this->parseStatus($model['fase']);
            $building->user_id = $model['id usuario cadastro'];

            $building->addRequeriments(AbstractParsedType::ADD, $address['bairro'], 'neighborhood');
            $building->addRequeriments(AbstractParsedType::ADD, $address['cidade'], 'city');

            return $building;
        } catch (FormatterException $e) {
            throw new ParserException("Problemas ao formatar o CEP", 0, $e);
        }
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


}