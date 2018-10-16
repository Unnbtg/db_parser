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

    public static function stringValue($value, $except = '', $default = null)
    {
        if ($value && !empty($value) && $value != $except) {
            return trim($value);
        }

        return $default;
    }

    public static function intValue($value, $except = '', $default = null)
    {
        if ($value && !empty($value) && $value != $except) {
            return (int)trim($value);
        }

        return $default;
    }

    public static function booleanValue($option)
    {
        $options = [
            'true',
            'sim',
        ];

        return in_array(self::cleanSpecialChars(trim($option)), $options);
    }

    public static function cleanSpecialChars($data)
    {
        $search  = array('/(À|Á|Ã|Â|à|á|ã|â)/', '/(É|Ê|é|ê)/', '/(Í|í)/', '/(Ó|Õ|Ô|ó|õ|ô)/', '/(Ú|Ü|ú|ü)/', '/(Ç|ç)/', '/ /');
        $replace = array('a', 'e', 'i', 'o', 'u', 'c', '_');

        return strtolower(preg_replace($search, $replace, $data));
    }
}