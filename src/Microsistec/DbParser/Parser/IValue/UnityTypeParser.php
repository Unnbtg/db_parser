<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 14:22
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\BuildingUnityType;
use Microsistec\DbParser\Exceptions\ParserException;

class UnityTypeParser extends AbstractParser
{

    protected $id;

    protected $types = [
        ["id" => 1, "name" => "Apartamento", "prefix" => "AP"],
        ["id" => 2, "name" => "Cobertura", "prefix" => "CO"],
        ["id" => 3, "name" => "Flat", "prefix" => "FL"],
        ["id" => 4, "name" => "Kitnet", "prefix" => "KI"],
        ["id" => 5, "name" => "Penthouse", "prefix" => "PE"],
        ["id" => 6, "name" => "Loft", "prefix" => "LF"],
        ["id" => 7, "name" => "Studio", "prefix" => "ST"],
        ["id" => 8, "name" => "Casa", "prefix" => "CA"],
        ["id" => 9, "name" => "Sobrado", "prefix" => "SB"],
        ["id" => 17, "name" => "Terreno", "prefix" => "AR"],
        ["id" => 17, "name" => "Área", "prefix" => "AR"],
        ["id" => 18, "name" => "Armazém", "prefix" => "AZ"],
        ["id" => 18, "name" => "Barracão", "prefix" => "AZ"],
        ["id" => 19, "name" => "Conjunto Comercial", "prefix" => "CC"],
        ["id" => 20, "name" => "Conjunto Industrial", "prefix" => "CI"],
        ["id" => 21, "name" => "Galeria", "prefix" => "GL"],
        ["id" => 22, "name" => "Galpão", "prefix" => "GP"],
        ["id" => 23, "name" => "Sala", "prefix" => "SA"],
        ["id" => 24, "name" => "Salão", "prefix" => "SLO"],
        ["id" => 25, "name" => "Loja", "prefix" => "LJ"],
        ["id" => 26, "name" => "Laje Corporativa", "prefix" => "LA"],
        ["id" => 27, "name" => "Indústria", "prefix" => "IN"],
        ["id" => 28, "name" => "Apartamento Duplex", "prefix" => "AP"],
        ["id" => 29, "name" => "Apartamento Triplex", "prefix" => "AP"],
        ["id" => 30, "name" => "Chácara", "prefix" => "AP"],
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $unity                  = new BuildingUnityType();
        $this->id               = $unity->maintence_id = $model['id unidade'];
        $unity->building_id     = $model['id empreendimento'];
        $unity->type            = $this->parseType($model['tipo']);
        $unity->bedroom         = $model['dormitorios'];
        $unity->suite           = $model['suites'];
        $unity->area_total      = $model['area total'];
        $unity->area_private    = $model['area privativa'];
        $unity->area_common     = $model['area comum'];
        $unity->room            = $model['salas'];
        $unity->bathroom        = $model['banheiros'];
        $unity->description     = $model['descricao'];
        $unity->characteristics = $this->parseCharacteristics($model);

        return $unity;
    }

    public function parseType($type)
    {
        $simplified = $this->simplifyConfig($this->types);

        if (!isset($simplified[$type])) {
            throw new ParserException("O Tipo da unidade tipo {$this->id} é inválido. Tipo enviado: " . $type);
        }

        return $simplified[$type];
    }

    public function parseCharacteristics($model)
    {
        $fromTo = [
            'piscina' => 'piscina',
        ];

        return $this->fromTo($fromTo, $model);
    }

}