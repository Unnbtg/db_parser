<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 05/07/16
     * Time: 11:20
     */

    namespace Microsistec\DbParser\Definition\PropertyType;

    /**
     * Class House
     * @package Microsistec\DbParser\Definition\PropertyType
     *
     *
     * @property string $subtype @see Constantes
     * @property array  $characteristics
     * @property int    $suite
     * @property int    $bathroom
     * @property int    $bedroom
     * @property int    $room
     * @property int    $kitchen
     * @property int    $garage_lot
     * @property int    $housekeeper_room
     * @property int    $service_area
     * @property int    $lavatory
     *
     */
    class House extends PropertyTypeAbstract
    {
        const ISOLADA = "isolada";
        const GEMINADA = "geminada";
        const SOBRADO = "sobrado";
        const ESQUINA = "esquina";
        const PADRAO = "padrao";
        const VILA = "vila";
        const CONDOMINIO_FECHADO = "condominio_fechado";
        const SOBREPOSTA_ALTA = "sobreposta_alta";
        const SOBREPOSTA_BAIXA = "sobreposta_baixa";
        const SEMI_ACABADA = "semi_acabada";
        const EDICULA = "edicula";
        const ALTO_PADRAO = "alto_padrao";
        const CASA_TERREA = "casa_terrea";
        const LOTEAMENTO_FECHADO = "loteamento_fechado";
        const KITCHNETEE = "kitchinete";
        const REFORMADA = "reformada";
        const CASA_RENDA = "casa_renda";
        const VILAGIO = "vilagio";
        const DUPLEX = "duplex";
        const TRIPLEX = "triplex";
        const FRENTE_MAR = "frente_mar";
        const ASSOBRADADO = "assobradado";

        public function __construct($model)
        {

            $this->subtype = $this->getSubtype($model->definicao_01);

            $this->characteristics = $this->getCharacteristics($model->definicao_master);
            $this->characteristics['external_area'] = $this->getExternalArea($model->definicao_02);

            $this->bedroom = $model->dorms;
            $this->suite = $model->suites;
            $this->bathroom = $model->banheiros;
            $this->room = $model->salas;
            $this->kitchen = $model->cozinhas;
            $this->garage_lot = $model->vagas_garagem;
            $this->housekeeper_room = $model->dep_empregada;
            $this->service_area = $model->area_servico;
            $this->lavatory = $model->lavabos;
        }


        protected function getSubtypesOptions()
        {
            return [
                'isolada',
                'geminada',
                'sobrado',
                'esquina',
                'padrao',
                'vila',
                'condominio_fechado',
                'sobreposta_alta',
                'sobreposta_baixa',
                'semi_acabada',
                'edicula',
                'alto_padrao',
                'casa_terrea',
                'loteamento_fechado',
                'kitchinete',
                'reformada',
                19 => 'casa_renda',
                'vilagio',
                'duplex',
                'triplex',
                'frente_mar',
                'assobradado',
            ];
        }

        protected function getExternalArea($definition)
        {
            return $this->extractLabelsFlagsSci($definition, $this->getExternalOptions());
        }

        protected function getCharacteristics($definition)
        {
            $characteristcs = [];

            $options = $this->getCharacteristicsOptions();

            $characteristcs['dorm'] = $this->extractLabelsFlagsSci(substr($definition, 0, 34), $options);
            $characteristcs['room'] = $this->extractLabelsFlagsSci(substr($definition, 34, 34), $options);
            $characteristcs['kitchen'] = $this->extractLabelsFlagsSci(substr($definition, 68, 34), $options);
            $characteristcs['bathroom'] = $this->extractLabelsFlagsSci(substr($definition, 102, 34), $options);
            $characteristcs['service_area'] = $this->extractLabelsFlagsSci(substr($definition, 136, 34), $options);
            $characteristcs['front'] = $this->extractLabelsFlagsSci(substr($definition, 170, 34), $options);
            $characteristcs['more_itens'] = $this->extractLabelsFlagsSci(substr($definition, 204, 34),
                $this->getMoreCharacteristicsOptions());

            return $characteristcs;
        }


        protected function getCharacteristicsOptions()
        {
            return [
                'piso_madeira',
                'piso_frio',
                'carpete',
                'ladrilho',
                'pedra',
                'granito',
                'alvenaria',
                'tijolinho',
                'litoceramica',
                'azulejo_teto',
                'azulejo_parcial',
                'massa_corrida',
                'pintura_texturizada',
                'gesso_moldura',
                'gesso_rebaixado',
                'em_l',
                'dois_ambientes',
                'tres_ambientes',
                'americana',
                'copa',
                'pia',
                'gabinete',
                'box_simples',
                'box_blindex',
                'closet',
                'hidromassagem',
                'gabinete',
                'janelas_madeira',
                'janelas_alumínio',
                'luminarias',
                'armario_embutido',
                'moveis_planejados',
                'ar_condicionado',
                'ventilador_teto',
            ];
        }

        public function getMoreCharacteristicsOptions()
        {
            return [
                'carpete_madeira',
                'piso_laminado',
                'piso_porcelanato',
                'gesso_sanca',
                'lavabo',
                'despensa',
                'escritorio',
                'porta_balcao',
                'cortina_vidro',
                'armarios_individuais',
                'churrasqueira_sacada',
                'medidores_agua_individuais',
                'lareira',
                'janela_ferro',
                'contra_piso',
                'pintura_latex',
                'serviços_pay_per_use',
                'deposito_garagem',
                'sistema_refrigeracao_central_tipo_sprit',
                'sistema_aquecimento_agua_a_gas',
                'perfil_estudantes',
                'pisopaviflex',
                'laje',
                'madeira',
                'pvc',
                'wc_empregada',
                'duas_entradas',
                'piso_ceramica',
                'piso_marmore',
                'piso_granito',
                'papel_de_parede',
            ];
        }


        protected function getExternalOptions()
        {
            return [
                'varanda',
                'lavanderia',
                'quintal',
                'churrasqueira',
                'piscina',
                'edicula',
                'terraço',
                'grades',
                'muros',
                'portao_automatico',
                'area_serviço',
                'jardim',
                'salao_festas',
                'sauna',
                'solarium',
                'interfone',
                'central_gas',
                'aquecimento_solar',
                'entrada_lateral',
                'deposito',
                'sacada',
                'sacada_panoramica',
                'forno_pao_pizza',
                'gerador_emergencia',
                'garagem_fechada',
                'piscina_aquecida',
                'deck_molhado',
                'parque_aquatico',
                'salao_jogos',
                'itness',
                'quadra_poliesportiva',
                'quadra_volei',
                'quadra_tênis',
                'espaco_gourmet',
                'espaco_grill',
                'playground',
                'brinquedoteca',
                'hall_social',
                'office',
                'cinema',
                'lan_house',
                'garage_band',
                'espaco_mulher',
                'spa',
                'atelier',
                'port_cochere',
                'hirante',
                'bangalo',
                'estar_pergolado',
                'espaço_zen',
                'redario',
                'pista_skate',
                'pista_caminhada',
                'pista_bocha',
                'pet_place',
                'praça_arvore',
                'pomar',
                'lago',
                'lavanderia_coletiva',
            ];
        }


        public function getTypeName()
        {
            return 'Casa';
        }
    }