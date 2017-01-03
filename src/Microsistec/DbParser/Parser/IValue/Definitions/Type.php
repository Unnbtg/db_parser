<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 20/12/16
 * Time: 11:52
 */

namespace Microsistec\DbParser\Parser\IValue\Definitions;


class Type
{

    const SITIO = 'sitio';
    const SALAO = 'salao';
    const CASA = 'casa';
    const SOBRADO = 'sobrado';
    const APARTAMENTO = 'apartamento';
    const TERRENO = 'terreno';
    const Sala= 'sala';

    const TYPE_COMERCIAL = 'comercial';
    const TYPE_RURAL = 'rural';
    const TYPE_RESIDENCIAL = 'residencial';

    public function getType($type)
    {
        switch ($type) {
            case "Sitio":
                return self::SITIO;
            case "Apartamento":
                return self::APARTAMENTO;
            case "salao":
                return self::SALAO;
            case "Casa":
                return self::CASA;
            case "Sobrado":
                return self::SOBRADO;
            case "Terreno":
                return self::TERRENO;
        }
    }

    public function getFinality($finality)
    {
        switch ($finality) {
            case "comercial":
                return self::TYPE_COMERCIAL;
            case 'residencial':
                return self::TYPE_RESIDENCIAL;
            case 'rural':
                return self::TYPE_RURAL;
        }
    }
}