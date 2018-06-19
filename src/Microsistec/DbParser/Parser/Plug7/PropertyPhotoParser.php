<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 11:37
 */

namespace Microsistec\DbParser\Parser\Plug7;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\PropertyPhoto;

class PropertyPhotoParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $propertyPhoto = new PropertyPhoto();

        $propertyPhoto->id          = (int)trim($model->id);
        $propertyPhoto->property_id = (int)trim($model->property_id);
        $propertyPhoto->created_at  = null;
        $propertyPhoto->name        = null;
        $propertyPhoto->path        = (string)trim($model->url);
        $propertyPhoto->position    = null;
        $propertyPhoto->highlight   = false;
        $propertyPhoto->hide        = trim($model->deletado) ? true : false;

        return $propertyPhoto;
    }

}