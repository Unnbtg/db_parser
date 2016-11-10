<?php
    namespace Microsistec\DbParser\Parser;

    use Microsistec\DbParser\Definition\Disponibility\Rent;
    use Microsistec\DbParser\Definition\Disponibility\Season;
    use Microsistec\DbParser\Definition\Disponibility\Sell;
    use Microsistec\DbParser\Definition\OldMasSAssignment;
    use Microsistec\DbParser\Definition\Photo;
    use Microsistec\DbParser\Definition\PropertyType\Apartament;
    use Microsistec\DbParser\Definition\PropertyType\Commercial;
    use Microsistec\DbParser\Definition\PropertyType\House;
    use Microsistec\DbParser\Definition\PropertyType\PropertyTypeAbstract;
    use Microsistec\DbParser\Definition\PropertyType\Rural;
    use Microsistec\DbParser\Definition\PropertyType\Terrain;
    use Microsistec\DbParser\Parser\Old\RentParser;
    use Microsistec\DbParser\Parser\Old\SeasonParser;
    use Microsistec\DbParser\Parser\Old\SellParser;
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
            $property->id = $model->id;
            $property->ml_id = $model->id_mercadolivre;
            $property->reference = $model->codigo;
            $type = $this->getPropertyType($model);
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
            $property->room = isset($type->room) ? $type->room : 0;
            $property->bedroom = isset($type->bedroom) ? $type->bedroom : 0;
            $property->bathroom = isset($type->bathroom) ? $type->bathroom : 0;
            $property->kitchen = isset($type->kitchen) ? $type->kitchen : 0;
            $property->lavatory = isset($type->lavatory) ? $type->lavatory : 0;
            $property->parking_lot = isset($type->parking_lot) ? $type->parking_lot : 0;
            $property->suites = isset($type->suite) ? $type->suite : 0;
            $property->garage_lot = isset($type->garage_lot) ? $type->garage_lot : 0;
            $property->housekeeper_room = isset($type->housekeeper_room) ? $type->housekeeper_room : 0;
            $property->valor_iptu = $model->valor_iptu;
            $property->package_mercadoLivre = $model->tipo_pacote_mercadolivre;
            $property->announcement_title = $model->titulo_anuncio;
            $property->video_url = isset($model->url_video) ? $model->url_video : '';
            $property->sell_price = $model->valor_venda;
            $property->rent_price = $model->valor_locacao;
            $property->total_area = $model->area_total;
            $property->web_obs = $model->web_obs;
            $property->featured_picture = $model->web_destaque_foto;
            $property->page_description = $model->descricao_pagina;
            $property->characteristics = array_filter($type->characteristics);
            $property->for_rent = 0;
            $property->for_sale = 0;
            $property->for_vacation = 0 ;
            $property->photos = null;
            $property->website_title = $model->titulo_pagina;
            $characteristics = $this->getCharacteristics($type->characteristics);
            $property->characteristics = $this->parseCharacteristics($characteristics);
            $seller_contact = $this->getContact($model->getBroker());
            $property->seller_contact = $this->parseContact($seller_contact);
            return $property;
        }


        public function getDisponibility($model)
        {
            $disponibilities = [];

            if ($model->disponibilidade[0]) {
                $disponibilities[] = $this->getSellObject($model);
            }

            if ($model->disponibilidade[1]) {
                $disponibilities[] = $this->getRentObject($model);
            }

            if (isset($model->disponibilidade[2]) && $model->disponibilidade[2]) {
                $disponibilities[] = $this->getSeasonObject($model);
            }

            return $disponibilities;
        }

        protected function getSellObject($model)
        {
            $parser = new SellParser;

            return $parser->parse($model, new OldMasSAssignment);
        }

        protected function getRentObject($model)
        {
            $parser = new RentParser;

            return $parser->parse($model, new OldMasSAssignment);
        }

        protected function getSeasonObject($model)
        {
            $parser = new SeasonParser;

            return $parser->parse($model, new OldMasSAssignment);
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

        public function getCharacteristics($array) {
            $return = array();
            array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
            return $return;
        }

        public function parseCharacteristics($array)
        {
            $var = [];
            foreach($array as $characteristic)
            {
                $var[] = ucfirst(str_replace('_', ' ', $characteristic));
            }
            return $var;

        }

        public function getContact($contact)
        {
            if(isset($contact))
            {
                return $contact->getInfo();
            }
        }

        public function parseContact($contact)
        {
            $array = [];
            $array['email'] = $contact['email'];
            $array['phone'] = preg_replace("/[^0-9]/", '',$contact['telefone']);
            $array['name'] = $contact['nome'];

            return $array;

        }

    }