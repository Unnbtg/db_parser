<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 10:40
 */

namespace Microsistec\DbParser\Parser\Imobex;


use Microsistec\DbParser\City;
use Microsistec\DbParser\Neighborhood;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;

abstract class AbstractParser extends ParserAbstract implements ParserInterface
{
    protected $states = [
        ["id" => 1, "name" => "AC"],
        ["id" => 2, "name" => "AL"],
        ["id" => 3, "name" => "AP"],
        ["id" => 4, "name" => "AM"],
        ["id" => 5, "name" => "BA"],
        ["id" => 6, "name" => "CE"],
        ["id" => 7, "name" => "DF"],
        ["id" => 8, "name" => "ES"],
        ["id" => 9, "name" => "GO"],
        ["id" => 10, "name" => "MA"],
        ["id" => 11, "name" => "MT"],
        ["id" => 12, "name" => "MS"],
        ["id" => 13, "name" => "MG"],
        ["id" => 14, "name" => "PA"],
        ["id" => 15, "name" => "PB"],
        ["id" => 16, "name" => "PR"],
        ["id" => 17, "name" => "PE"],
        ["id" => 18, "name" => "PI"],
        ["id" => 19, "name" => "RJ"],
        ["id" => 20, "name" => "RN"],
        ["id" => 21, "name" => "RS"],
        ["id" => 22, "name" => "RO"],
        ["id" => 23, "name" => "RR"],
        ["id" => 24, "name" => "SC"],
        ["id" => 25, "name" => "SP"],
        ["id" => 26, "name" => "SE"],
        ["id" => 27, "name" => "TO"],
    ];

    public function maskCep($cep)
    {
        return substr_replace(preg_replace("/[^0-9]/", "", $cep), '-', 5, 0);
    }

    public function createCity($cityId, $stateId, $name)
    {
        $city           = new City();
        $city->id       = $cityId;
        $city->state_id = $stateId;
        $city->name     = $name;

        return $city;
    }

    public function createNeighborhood($neighborhoodId, $cityId, $name)
    {
        $neighborhood = new Neighborhood();

        $neighborhood->id      = $neighborhoodId;
        $neighborhood->name    = $name;
        $neighborhood->city_id = $cityId;

        return $neighborhood;
    }

    protected function fromTo($fromTo, $analise)
    {
        $contains = [];
        foreach ($fromTo as $key => $value) {
            if (
                isset($analise[$value]) && $this->booleanValue($analise[$value])
            ) {
                $contains[] = $key;
            }
        }
        return $contains;
    }

    protected function booleanValue($value)
    {
        if ($this->isSimNao($value)) {
            return $this->simNaoToBool($value);
        }

        return (bool)$value;
    }

    private function isSimNao($value)
    {
        $string = strtolower($value);

        return $string == "sim" || $string == "não" || $string == 'nao' || $string == 's' || $string == 'n';
    }

    public function simNaoToBool($option)
    {
        if ($option == 'Sim' || $option == 'True' || $option == 'S') {
            return true;
        }

        if ($option == "Não" || $option == 'False' || $option == 'N') {
            return false;
        }

        return false;
    }

    protected function formatDate($date)
    {
        if (empty($date) || $date == '0000-00-00') {
            return null;
        }

        $newDate = new \DateTime($date);

        return $newDate->format('Y-m-d H:i:s');
    }

    protected function getState($state)
    {
        return $this->getFromComplexConfig($state, $this->states);
    }

    public function getFromComplexConfig($value, $config)
    {
        $simplerConfig = $this->simplifyConfig($config);

        if (isset($simplerConfig[$value])) {
            return $simplerConfig[$value];
        }

        return false;
    }

    protected function simplifyConfig($array)
    {
        $result = [];
        array_map(function ($item) use (&$result) {
            $result[$item['name']] = $item['id'];
            return $result;
        }, $array);

        return $result;
    }
}