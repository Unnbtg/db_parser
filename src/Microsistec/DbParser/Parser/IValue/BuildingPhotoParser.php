<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 16:43
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\BuildingPhoto;
use Microsistec\DbParser\Exceptions\ParserException;

class BuildingPhotoParser extends AbstractParser
{
    protected $id;

    protected $category = [
             ["id" => 1, "name" => "Estrutura", "prefix" => "ES"],
             ["id" => 2, "name" => "Planta", "prefix" => "PL"],
             ["id" => 3, "name" => "Fase da Obra", "prefix" => "FO"],
             ["id" => 4, "name" => "Área Comum", "prefix" => "AC"],
             ["id" => 5, "name" => "Fotos", "prefix" => "FT"],
             ["id" => 6, "name" => "Fotos do Decorado", "prefix" => "FD"]
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $foto = new BuildingPhoto();

        $this->id = $foto->maintence_id = $model['id foto'];
        $foto->path = $model['url grande'];
        $foto->thumb_path = $model['url miniatura'];
        $foto->name = $model['legenda'];
        $foto->position = $model['ordem'];
        $foto->building_id = $model['id empreendimento'];
        $foto->category = $this->parseCategory($model['tipo']);

        return $foto;
    }

    public function parseCategory($category)
    {
        $simplified = $this->simplifyConfig($this->category);

        if (!isset($simplified[$category])) {
            throw new ParserException("A categoria da foto de ID {$this->id} está inválida. Categoria informada: ". $category);
        }

        return $simplified[$category];
    }


}