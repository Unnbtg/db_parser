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

}