<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 18/10/17
 * Time: 16:16
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\PropertyPhoto;

class PropertyPhotoParser extends AbstractParser
{
    public function parse($model, $domain = "", $account = "")
    {
        $propertyPhoto = new PropertyPhoto();

        $propertyPhoto->id          = $model['id foto'];
        $propertyPhoto->property_id = $model['id imovel'];
        $propertyPhoto->created_at  = $model['data cadastro'];
        $propertyPhoto->name        = $model['legenda'];
        $propertyPhoto->path        = $model['url grande'];
        $propertyPhoto->position    = $model['ordem'];
        $propertyPhoto->highlight   = $this->simNaoToBool($model['destaque']);
        $propertyPhoto->hide        = !$this->simNaoToBool($model['site']); //se o valor for não é pra esconder pq eles usam o "sim" pra mostrar

        return $propertyPhoto;

    }

}