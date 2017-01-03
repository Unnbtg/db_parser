<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 09:40
 */

namespace Microsistec\DbParser;


use Microsistec\DbParser\Exceptions\FormatterException;

class Formatter
{

    public static function zipcode($string)
    {
        if (strlen($string) < 8) {
            throw new FormatterException("CEP Inválido:". $string);
        }

        if (strpos($string, '-') !== false) {
            return $string;
        }

        return substr_replace($string, '-', 5, 0);
    }
}