<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 22/12/16
 * Time: 15:31
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\Branch;
use Microsistec\DbParser\Property;

class BranchParser extends AbstractParser
{
    public function parse($model, $domain = "", $account = "")
    {
        $branch = new Branch();

        $branch->name = $model['nome fantasia'];
        $branch->street = $model['tipo logradouro'] . " " . $model['logradouro'];
        $branch->street_number = $model['numero'];

        return $branch;

    }


}