<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 10:40
 */

namespace Microsistec\DbParser\Parser\Tecimob;


use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;

abstract class AbstractParser extends ParserAbstract implements ParserInterface
{
    public function maskCep($cep)
    {
        return substr_replace(preg_replace("/[^0-9]/", "", $cep), '-', 5, 0);
    }

    protected function formatDate($date)
    {
        if (empty($date) || $date == '0000-00-00') {
            return null;
        }

        $obj = \DateTime::createFromFormat('!d/m/Y', $date);

        if (!$obj) {
            return null;
        }

        return $obj->format('Y-m-d H:i:s');
    }

    protected function parsePhones($model)
    {
        $phones = [];

        if ($model['telefone']) {
            $phone  = new \stdClass();
            $phone->phone = $this->unMask($model['telefone']);
            $phones[] = $phone;
        }

        if ($model['celular']) {
            $phone  = new \stdClass();
            $phone->phone = $this->unMask($model['celular']);
            $phones[] = $phone;
        }

        return $phones;
    }

    protected function cleanSpecialChars($data)
    {
        $search = array('/(À|Á|Ã|Â|à|á|ã|â)/', '/(É|Ê|é|ê)/', '/(Í|í)/', '/(Ó|Õ|Ô|ó|õ|ô)/', '/(Ú|Ü|ú|ü)/', '/(Ç|ç)/');
        $replace = array('a', 'e', 'i', 'o', 'u', 'c');

        return strtolower(preg_replace($search, $replace, $data));
    }
}