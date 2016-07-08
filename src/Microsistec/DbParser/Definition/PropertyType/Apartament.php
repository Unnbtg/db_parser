<?php

    namespace Microsistec\DbParser\Definition\PropertyType;

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 04/07/16
     * Time: 15:34
     *
     *
     * @property string $subtype Sub-tipo do imóvel
     * @property array  $characteristics
     * @property int    $suite
     * @property int    $bathroom
     * @property int    $bedroom
     * @property int    $room
     * @property int    $kitchen
     * @property int    $garage_lots
     * @property int    $housekeeper_room
     * @property int    $service_area
     * @property int    $lavatory
     *
     */
    class Apartament extends PropertyTypeAbstract
    {

        const PADRAO = 'padrao';
        const KITCHINETE = 'kitchinete';
        const COBERTURA = 'cobertura';
        const DUPLEX = 'duplex';
        const TRIPLEX = 'triplex';
        const ALTO_PADRAO = 'alto_Padrao';
        const UM_POR_ANDAR = '1_por_andar';
        const FLAT = 'flat';
        const SALA_LIVING = 'sala_living';
        const MEDIO = 'medio';
        const GRANDE = 'grande';
        const TERREO = 'terreo';
        const LOFT = 'loft';
        const VISTA_MAR = 'vista_Mar';
        const REFORMADO = 'reformado';
        const FINANCIAMENTO_DIRETO = 'financiamento_direto';
        const FINANCIAMENTO_BANCARIO = 'financiamento_bancário';
        const SEM_CONDOMINIO = 'sem_condomínio';
        const FRENTE_MAR = 'frente_mar';
        const STUDIO = 'studio';
        const TIPO_CASA = 'tipo_casa';
        const CAMPO = 'campo';
        const PENTHOUSE = 'penthouse';
        const GARDEN = 'garden';
        const GARDEN_ELEVADO = 'garden_elevado';
        const SEM_SUBTIPO = 'sem_subtipo';

        public function __construct($model)
        {
            $this->subtype = $this->getSubtype($model->definicao_01);

            $this->characteristics = $this->getCharacteristics($model->definicao_master);
            $this->characteristics['leisure'] = $this->getLeisures($model->definicao_02);
            $this->characteristics['external_area'] = $this->getExternalArea($model->definicao_03);
            $this->characteristics['security'] = $this->getSecurity($model->definicao_04);
            $this->characteristics['internal_area'] = $this->getSecurity($model->definicao_05);

            $this->bedroom = $model->dorms;
            $this->suite = $model->suites;
            $this->bathroom = $model->banheiros;
            $this->room = $model->salas;
            $this->kitchen = $model->cozinhas;
            $this->garage_lots = $model->vagas_garagem;
            $this->housekeeper_room = $model->dep_empregada;
            $this->service_area = $model->area_servico;
            $this->lavatory = $model->lavabos;
        }

        protected function getSubtypesOptions()
        {
            return [
                0 => 'padrao',
                'kitchinete',
                'cobertura',
                'duplex',
                'triplex',
                'alto_Padrao',
                '1_por_andar',
                'flat',
                'sala_living',
                'medio',
                'grande',
                'terreo',
                'loft',
                'vista_Mar',
                'reformado',
                'financiamento_direto',
                'financiamento_bancário',
                'sem_condomínio',
                'frente_mar',
                'studio',
                'tipo_casa',
                'campo',
                'penthouse',
                'garden',
                'garden_elevado',
            ];
        }

        protected function getCharacteristics($definition)
        {
            $characteristcs = [];

            $options = $this->getCharacteristicsOptions();

            $characteristcs['bedroom'] = $this->extractLabelsFlagsSci(substr($definition, 0, 34), $options);
            $characteristcs['room'] = $this->extractLabelsFlagsSci(substr($definition, 34, 34), $options);
            $characteristcs['kitchen'] = $this->extractLabelsFlagsSci(substr($definition, 68, 34), $options);
            $characteristcs['bathroom'] = $this->extractLabelsFlagsSci(substr($definition, 102, 34), $options);
            $characteristcs['service_area'] = $this->extractLabelsFlagsSci(substr($definition, 136, 34), $options);
            $characteristcs['front'] = $this->extractLabelsFlagsSci(substr($definition, 170, 34), $options);
            $characteristcs['more_itens'] = $this->extractLabelsFlagsSci(substr($definition, 204, 34),
                $this->getMoreCharacteristicsOptions());

            return $characteristcs;
        }

        protected function getLeisures($definition)
        {
            return $this->extractLabelsFlagsSci($definition, $this->getLeisuresOptions());
        }

        protected function getExternalArea($definition)
        {
            return $this->extractLabelsFlagsSci($definition, $this->getExternalAreaOptions());
        }

        protected function getInternalArea($definition)
        {
            return $this->extractLabelsFlagsSci($definition, $this->getInternalAreaOptions());
        }

        protected function getSecurity($definition)
        {
            $options = [
                'guarita',
                'portaria',
                'portao_eletronico',
                'circuito_fechado_tv',
                'interfone',
                'alarme_monitorado',
                'vigia',
                'vaga_anti-sequestro',
            ];

            return $this->extractLabelsFlagsSci($definition, $options);
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


        public function getLeisuresOptions()
        {
            return [
                'salao_de_festas',
                'salao_de_jogos',
                'sala_de_ginastica',
                'sauna_seca',
                'parabolica',
                'tv_assinatura',
                'solarium',
                'garage_band',
                'atelier',
                'lan_house',
                'brinquedoteca',
                'cinema',
                'espaco_gourmet',
                'Espaco_grill',
                'spa',
                'lazer_na_cobertura',
                'wi_fi',
                'piscina_cobertura',
                'sauna_vapor',
                'jacuzzi',
            ];
        }


        public function getExternalAreaOptions()
        {
            return [
                'churrasqueira',
                'quadra_poliesportiva',
                'piscina_adulto',
                'piscina_infantil',
                'jardim',
                'servico_de_praia',
                'play_ground',
                'elevador_cadeirante',
                'entrada_lateral',
                'deposito',
                'sacada_panoramica',
                'forno_pao_pizza',
                'gerador_emergencia',
                'quadra_tenis',
                'quadra_volei',
                'piscina_aquecida',
                'deck_molhado',
                'parque_aquatico',
                'mirante',
                'port_cochere',
                'pet_place',
                'pista_skate',
                'pista_caminhada',
                'pista_bocha',
                'bangalo',
                'espaco_zen',
                'estar_pergolado',
                'redario',
                'praca_arvore',
                'pomar',
                'lago',
                'deck_barco',
                'sacada_tecnica',
            ];
        }

        public function getInternalAreaOptions()
        {
            return [
                'elevador_social',
                'elevador_serviço',
                'hall_entrada',
                'entrada_serviço',
                'central_gas',
                'garagem_privativa',
                'garagem_coletiva_suficiente',
                'garagem_coberta',
                'sacada',
                'terraco',
                'area_servico',
                'garagem_fechada',
                'garagem_demarcada',
                'varanda_gourmet',
                'garagem_escriturada',
                'office',
                'espaco_mulher',
                'lavanderia_coletiva',
                'bicicletario',
                'espaco_motos',
                'elevador_seguranca',
                'garagem_ar_livre',
                'manobrista',
                'telefonia_pabx',
                'garagem_coletiva_insuficiente',
                'varanda',
            ];
        }


        public function getTypeName()
        {
            return 'apartament';
        }
    }