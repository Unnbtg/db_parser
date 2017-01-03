<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/07/16
 * Time: 14:26
 */

namespace Microsistec\DbParser\Parser;


use Illuminate\Database\Eloquent\Model;
use Microsistec\DbParser\Property;

abstract class ParserAbstract
{

    /**
     * @param $model
     * @return Property
     */
    public abstract function parse($model, $domain ="", $account = "");

}