<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 01/07/16
     * Time: 14:24
     */

    namespace Microsistec\DbParser\Parser;

    use Microsistec\DbParser\Definition\Disponibility\Rent;
    use Microsistec\DbParser\Definition\Disponibility\Season;
    use Microsistec\DbParser\Definition\Disponibility\Sell;
    use Microsistec\DbParser\Definition\Photo;
    use Microsistec\DbParser\Definition\PropertyType\Apartament;
    use Microsistec\DbParser\Definition\PropertyType\Commercial;
    use Microsistec\DbParser\Definition\PropertyType\House;
    use Microsistec\DbParser\Definition\PropertyType\PropertyTypeAbstract;
    use Microsistec\DbParser\Definition\PropertyType\Rural;
    use Microsistec\DbParser\Definition\PropertyType\Terrain;
    use Microsistec\DbParser\Property;

    /**
     * Class OldParser
     * @package Microsistec\DbParser\Parser
     *
     * @property \stdClass $model
     */
    class OldParser extends ParserAbstract
    {
        public function parse($model, $domain = "", $account = "")
        {
            $property = new Property();

            $type = $this->getPropertyType($model);

            $property->reference = $model->ref_alternativa;

            $property->type = $type->getTypeName();
            $property->subtype = $type->subtype;
            $property->disponibility = $this->getDisponibility($model);

            $property->address = $model->endereco;
            $property->number = $model->numero;
            $property->complement = $model->complemento;
            $property->cep = $model->cep;
            $property->city = $model->cidade;
            $property->neighborhood = $model->bairro;
            $property->state = $model->uf;
            $property->zone = $model->zona;

            $property->age = $model->idade_imovel;

            $property->useful_area = $model->area_util;
            $property->total_area = $model->area_total;
            $property->parser = $this;
            $this->model = $model;
            return $property;
        }


        public function getDisponibility($model)
        {
            $disponibilities = [];

            if ($model->disponibilidade[0]) {
                $disponibilities[] = new Sell($model);
            }

            if ($model->disponibilidade[1]) {
                $disponibilities[] = new Rent($model);
            }

            if (isset($model->disponibilidade[2]) && $model->disponibilidade[2]) {
                $season = new Season($model);
                $disponibilities[] = $season;
            }

            return $disponibilities;
        }

        /**
         * @param $model
         *
         * @return PropertyTypeAbstract
         */
        public function getPropertyType($model)
        {
            switch ($model->tipo_imovel) {
                case '0':
                    return new House($model);
                case '1':
                    return new Apartament($model);
                case '2':
                    return new Terrain($model);
                case '4':
                    return new Commercial($model);
                case '5':
                    return new Rural($model);
            }
        }

    }