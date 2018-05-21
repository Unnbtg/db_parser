<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 07/02/18
 * Time: 11:15
 */

namespace Microsistec\DbParser\Parser\Coruja;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\PropertyPhoto;

class PropertyPhotoParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $propertyPhoto = new PropertyPhoto();

        $propertyPhoto->property_id = $model['COD_IMOVEL'];
        $propertyPhoto->path        = $model['url'];

        return $propertyPhoto;
    }

}