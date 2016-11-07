<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 05/07/16
     * Time: 14:31
     */

    namespace Microsistec\DbParser\Definition\PropertyType;


    /**
     * Class Terrain
     * @package Microsistec\DbParser\Definition\PropertyType
     *
     *
     * @property array  $characteristics
     * @property string $subtype
     * @property int    $ground_type
     *
     */
    class Terrain extends PropertyTypeAbstract
    {

        const SIMPLES = "simples";
        const INCORPORACAO = "incorporacao";
        const SITIO = "sitio";
        const FAZENDA = "fazenda";
        const CHACARA = "chacara";
        const LOTEAMENTO = "loteamento";
        const AREA_INDUSTRIAL = "area_industrial";
        const CONDOMINIO_FECHADO = "condominio_fechado";
        const TERRENO_RESIDENCIAL = "terreno_residencial";
        const TERRENO_COMERCIAL = "terreno_comercial";
        const EMPREENDIMENTO = "empreendimento";
        const AREA_PORTUARIA = "area_portuaria";
        const AREA_COMERCIAL = "area_comercial";
        const AREA_RESIDENCIAL = "area_residencial";
        const AREA_RETROPORTUARIA = "area_retroportuaria";
        const TERRENO_INDUSTRIAL = "terreno_industrial";


        const GROUND_TYPE_ARENOSO = 0;
        const GROUND_TYPE_ARGILOSO = 1;
        const GROUND_TYPE_TERRA_ROXA = 2;
        const GROUND_TYPE_MANGUE = 3;
        const GROUND_TYPE_PEDREGOSO = 4;
        const GROUND_TYPE_PLANO = 5;
        const GROUND_TYPE_DECLIVE = 6;
        const GROUND_TYPE_ACLIVE = 7;
        const GROUND_TYPE_LEVEL_DECLIVE = 8;
        const GROUND_TYPE_LEVE_ACLIVE = 9;

        public function __construct($model)
        {
            $this->subtype = $this->getSubtype($model->definicao_01);
            $this->characteristics = $this->getCharacteristics($model->definicao_master);
            $this->ground_type = (int)$model->definicao_02;
        }

        public function getSubtype($options)
        {
            return $this->getSubtypesOptions()[$options];
        }

        protected function getSubtypesOptions()
        {
            return [
                0 => 'simples',
                'incorporacao',
                'sitio',
                'fazenda',
                'chacara',
                'loteamento',
                'area_industrial',
                'condominio_fechado',
                'terreno_residencial',
                'terreno_comercial',
                'empreendimento',
                'area_comercial',
                'area_residencial',
                'area_portuaria',
                'area_retroportuaria',
                'terreno_industrial',
            ];
        }

        protected function getCharacteristics($definition)
        {
            $characteristics = [];

            $characteristics['proximity'] = $this->extractLabelsFlagsSci(substr($definition, 0, 6),
                $this->getProximityOptions()); //6.
            $characteristics['needs'] = $this->extractLabelsFlagsSci(substr($definition, 6, 4),
                $this->getNeedsToOptions()); //4.
            $characteristics['definition'] = $this->extractLabelsFlagsSci(substr($definition, 10, 6),
                $this->getDefinitionOptions()); //5


            return $characteristics;

        }


        protected function getProximityOptions()
        {
            return [
                'padaria',
                'supermercado',
                'pronto_onibus',
                'escola',
                'rua_asfaltada',
                'rua_calcada',
            ];
        }

        public function getNeedsToOptions()
        {
            return [
                'terraplanagem',
                'nivelamento',
                'demolicao',
                'aterro',
            ];
        }

        public function getDefinitionOptions()
        {
            return [
                'padrao',
                'meio_lote',
                'esquina',
                'desmembramento',
                'alto_padrao',
            ];
        }

        public function getTypeName()
        {
            return "Terreno";
        }


    }