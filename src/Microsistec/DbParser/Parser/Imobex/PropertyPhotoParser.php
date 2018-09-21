<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 11:37
 */

namespace Microsistec\DbParser\Parser\Imobex;


use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\PropertyPhoto;

class PropertyPhotoParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $propertyPhoto = new PropertyPhoto();

        $propertyPhoto->id          = (int)trim($model->cd_foto);
        $propertyPhoto->property_id = (int)trim($model->cd_imovel);
        $propertyPhoto->created_at  = $this->formatDate((string)$model->fl_process_data);
        $propertyPhoto->name        = null;
        $propertyPhoto->path        = (string)trim($domain[0]) . trim((int)$model->cd_imovel) . '-' . trim((int)($model->cd_foto)) . '.' . trim((string)$model->extensao);
        $propertyPhoto->position    = (string)$model->order ?: null;
        $propertyPhoto->highlight   = false;
        $propertyPhoto->hide        = (bool)$model->apagar;

        return $propertyPhoto;
    }

}