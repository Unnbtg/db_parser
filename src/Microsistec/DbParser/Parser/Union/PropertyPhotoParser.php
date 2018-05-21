<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 11:37
 */

namespace Microsistec\DbParser\Parser\Union;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\PropertyPhoto;

class PropertyPhotoParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $propertyPhoto = new PropertyPhoto();

        $propertyPhoto->id          = (int)trim($model->codigo);
        $propertyPhoto->property_id = (int)trim($model->fkimovel);
        $propertyPhoto->created_at  = (string)trim($model->paratime);
        $propertyPhoto->name        = (string)trim($model->descricao);
        $propertyPhoto->path        = (string)trim($model->url);
        $propertyPhoto->position    = (int)trim($model->ordem);
        $propertyPhoto->highlight   = (int)trim($model->ordem) == 1 ? true : false;
        $propertyPhoto->hide        = false;

        return $propertyPhoto;
    }

}