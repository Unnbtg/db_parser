<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/07/16
 * Time: 14:26
 */

namespace Microsistec\DbParser\Parser;

use Microsistec\DbParser\AbstractParsedType;

abstract class ParserAbstract
{
    protected $states = [
        ["id" => 1, "name"  => "AC"],
        ["id" => 2, "name"  => "AL"],
        ["id" => 3, "name"  => "AP"],
        ["id" => 4, "name"  => "AM"],
        ["id" => 5, "name"  => "BA"],
        ["id" => 6, "name"  => "CE"],
        ["id" => 7, "name"  => "DF"],
        ["id" => 8, "name"  => "ES"],
        ["id" => 9, "name"  => "GO"],
        ["id" => 10, "name"  => "MA"],
        ["id" => 11, "name"  => "MT"],
        ["id" => 12, "name"  => "MS"],
        ["id" => 13, "name"  => "MG"],
        ["id" => 14, "name"  => "PA"],
        ["id" => 15, "name"  => "PB"],
        ["id" => 16, "name"  => "PR"],
        ["id" => 17, "name"  => "PE"],
        ["id" => 18, "name"  => "PI"],
        ["id" => 19, "name"  => "RJ"],
        ["id" => 20, "name"  => "RN"],
        ["id" => 21, "name"  => "RS"],
        ["id" => 22, "name"  => "RO"],
        ["id" => 23, "name"  => "RR"],
        ["id" => 24, "name"  => "SC"],
        ["id" => 25, "name"  => "SP"],
        ["id" => 26, "name"  => "SE"],
        ["id" => 27, "name"  => "TO"]
    ];

    /**
     * @param $model
     * @param string $domain
     * @param string $account
     * @return AbstractParsedType
     */
    public abstract function parse($model, $domain = "", $account = "");

    public function maskCep($cep)
    {
        return substr_replace(preg_replace("/[^0-9]/", "", $cep), '-', 5, 0);
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

    public function unMask($data)
    {
        return preg_replace("/[^0-9]/", "", $data);
    }

    protected function formatDate($date)
    {
        $date = str_replace('/', '-', $date);
        if (empty($date)) {
            return "";
        }

        $date = explode(' ', $date);

        if (count($date) == 1) {
            $date = $date[0];
            return implode('-', array_reverse(explode('/', $date)));

        }


        $time = strtotime($date[0] . " " . $date[1]);

        if (isset($date[2]) && $date[2] == "PM") {
            return date('Y-m-d H:i:s', strtotime("+ 12 hours", $time));
        }

        return date('Y-m-d H:i:s', $time);
    }

}