<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 11:37
 */

namespace Microsistec\DbParser\Parser\Tecimob;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\PropertyPhoto;

class PropertyPhotoParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $code = explode('-',(string)trim($domain));

        $propertyPhoto = new PropertyPhoto();
        $propertyPhoto->id          = $account;
        $propertyPhoto->property_id = $code[0];
        $propertyPhoto->created_at  = null;
        $propertyPhoto->name        = null;
        $propertyPhoto->path        = (string)trim($model);
        $propertyPhoto->position    = null;
        $propertyPhoto->highlight   = false;
        $propertyPhoto->hide        = false;

        return $propertyPhoto;
    }

}