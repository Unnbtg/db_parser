<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 11:37
 */

namespace Microsistec\DbParser\Parser\Plug7;


use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\PropertyOwner;

class PropertyOwnerParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $propertyOwner = new PropertyOwner();

        $propertyOwner->id          = (int)trim($model->id);
        $propertyOwner->owner_id    = (int)trim($model->proprietario_id);
        $propertyOwner->property_id = (int)trim($model->imovel_id);

        return $propertyOwner;
    }

}