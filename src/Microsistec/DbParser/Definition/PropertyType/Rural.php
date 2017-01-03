<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 07/07/16
     * Time: 10:13
     */

    namespace Microsistec\DbParser\Definition\PropertyType;


    /**
     * Class Rural
     * @package Microsistec\DbParser\Definition\PropertyType
     *
     * @property array  $characteristics
     * @property string $subtype
     * @property int    $suite
     * @property int    $bathroom
     * @property int    $bedroom
     * @property int    $room
     * @property int    $kitchen
     * @property int    $garage_lot
     * @property int    $housekeeper_room
     * @property int    $service_area
     * @property int    $lavatory
     */
    class Rural extends PropertyTypeAbstract
    {

        const CHACARA = 'chacara';
        const SITIO = 'sitio';
        const FAZENDA = 'fazenda';
        const HARAS = 'haras';
        const RANCHO = 'rancho';

        public function __construct($model)
        {
            $characteristics = [];

            $this->subtype = $this->getSubtype($model->definicao_01);

            $characteristics['infrastructure'] = $this->getCharacteristics($model->definicao_master);
            $characteristics['improvements'] = $this->getImprovments($model->definicao_02);
            $characteristics['external_area'] = $this->getExternalArea($model->definicao_03);

            $this->bedroom = $model->dorms;
            $this->suite = $model->suites;
            $this->bathroom = $model->banheiros;
            $this->room = $model->salas;
            $this->kitchen = $model->cozinhas;
            $this->garage_lot = $model->vagas_garagem;
            $this->housekeeper_room = $model->dep_empregada;
            $this->service_area = $model->area_servico;
            $this->lavatory = $model->lavabos;

            $this->characteristics = $characteristics;
        }

        public function getSubtype($options)
        {
            return $this->getSubtypesOptions()[$options];
        }

        protected function getSubtypesOptions()
        {
            return [
                0 => self::CHACARA,
                self::SITIO,
                self::FAZENDA,
                self::HARAS,
                self::RANCHO,
            ];
        }

        protected function getCharacteristics($options)
        {
            return $this->extractLabelsFlagsSci($options, $this->getCharacteristicsOptions());
        }

        protected function getCharacteristicsOptions()
        {
            return [
                "play-ground",
                "salao_jogos",
                "campos_futebol",
                "churrasqueira",
                "fogao_lenha",
                "forno_pizza",
                "sala_ginastica",
                "sauna_seca_umida",
                "quadra_poliesportiva",
                "piscina",
                "jardim",
                "pomar",
                "horta",
                "cachoeira",
                "mata_nativa",
                "nascente",
                "pecuaria_leite",
                "pecuaria_corte",
                "avicultura",
                "suinocultura",
                "equinocultura",
                "ovicultura",
                "piscicultura",
                "ranario",
                "avestruz",
                "granja",
                "cana",
                "cafe",
                "soja",
                "milho",
                "laranja",
                "mortalicas",
                "energia_pablica",
                "gerador_proprio",
                "rede_publica",
                "poco_artesiano",
                "poco_semi_artesiano",
                "poco_caipira",
                "mina",
                "corrego",
            ];
        }


        public function getImprovments($definition)
        {
            $options = [
                'casa_caseiro',
                'salao_festas',
                'capela',
                'curral',
                'paiol',
                'redondel',
                'estabulo',
                'galpao',
                'cocheira',
                'piquete',
                'tuia',
                'terreiros_cafe',
                'silos_graos',
                'mangueira',
            ];

            return $this->extractLabelsFlagsSci($definition, $options);
        }

        public function getExternalArea($definition)
        {
            $options  = [
                'portal_entrada',
                'cerca_arame_liso',
                'cerca_regua',
                'cerca_arama_farpado',
                'guarita',
                'asfalto',
                'sem_calcamento',
                'pedregulho',
                'paralelepipedo',
                'cerca_eletrica',
                'sistema_seguranca',
            ];

            return $this->extractLabelsFlagsSci($definition, $options);
        }

        public function getTypeName()
        {
            return 'Rural';
        }


    }