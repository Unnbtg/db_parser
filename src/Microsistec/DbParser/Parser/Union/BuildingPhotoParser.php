<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 08/05/18
 * Time: 10:02
 */

namespace Microsistec\DbParser\Parser\Union;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\BuildingPhoto;
use Microsistec\DbParser\Exceptions\ParserException;
use Microsistec\DbParser\Parser\ParserInterface;

class BuildingPhotoParser extends AbstractParser implements ParserInterface
{
    protected $category = [
        ["id" => 1, "name" => "Implantação", "prefix" => "ES"],
        ["id" => 2, "name" => "Planta", "prefix" => "PL"],
        ["id" => 3, "name" => "Obras", "prefix" => "FO"],
        ["id" => 4, "name" => "Lazer", "prefix" => "AC"],
        ["id" => 5, "name" => "Projeto", "prefix" => "FT"],
        ["id" => 5, "name" => "Logo", "prefix" => "FT"],
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $foto = new BuildingPhoto();

        $this->id          = $foto->maintence_id = $foto->id = (int)$model->codigo;
        $foto->path        = (string)$model->url;
        $foto->thumb_path  = (string)$model->url;
        $foto->name        = (string)$model->descricao;
        $foto->position    = (int)$model->ordem;
        $foto->building_id = (int)$model->fkempre;
        $foto->category    = $this->parseCategory((string)$model->tipo);

        return $foto;
    }

    public function parseCategory($category)
    {
        $simplified = $this->simplifyConfig($this->category);

        if (!isset($simplified[$category])) {
            throw new ParserException("A categoria da foto de ID {$this->id} está inválida. Categoria informada: " . $category);
        }

        return $simplified[$category];
    }

}