<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 20/03/17
 * Time: 12:24
 */

namespace Microsistec\DbParser\Parser\Desktop;


use Microsistec\DbParser\Building;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Property;

class BuildingParser extends ParserAbstract implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $building = new Building();
        $building->id = $model->id;
    }

}