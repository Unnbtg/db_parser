<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 05/07/16
     * Time: 16:35
     */

    namespace Microsistec\DbParser\Definition\PropertyType;


    /**
     * Class Commercial
     * @package Microsistec\DbParser\Definition\PropertyType
     *
     * @property string $subtype
     * @property array  $characteristics
     * @property int    $right_foot
     * @property int    $rooms
     * @property int    $bathroom
     * @property int    $parking_lot
     * @property int    $garage_lot
     * @property int    $refectory
     * @property int    $docks
     * @property int    $windows
     * @property int    $front_doors
     *
     */
    class Commercial extends PropertyTypeAbstract
    {

        const LOJA = "loja";
        const SALA_COMERCIAL = "sala_comercial";
        const GALPAO_COMERCIAL = "galpao_comercial";
        const CONSULTORIO = "consultorio";
        const GALERIA = "galeria";
        const SOBRELOJA = "sobreloja";
        const ESCOLA = "escola";
        const LANCHONETE = "lanchoente";
        const RESTAURANTE = "restaurante";
        const QUIOSQUE = "quioque";
        const SUPERMERCADO = "supermercado";
        const MINI_MERCADO = "mini_mercado";
        const PADARIA = "padaria";
        const SALAO_COMERCIAL = "salao_comercial";
        const BARRACAO_COMERCIAL = "barracao_comercial";
        const CONJUNTO_COMERCIAL = "conjunto_comercial";
        const POUSADA = "pousada";
        const HOTEL = "hotel";
        const CASA_COMERCIAL = "casa_comercial";
        const INDUSTRIA = "industria";
        const PREDIO_COMERCIAL = "predio_comercial";
        const GALPAO_INDUSTRIAL = "galpao_industrial";
        const SHOPPING = "shopping";
        const USINAS = "usinas";
        const PCH = "pch";
        const MINERADORAS = "mineradoras";
        const JAZIDAS = "jazindas";
        const SPA = "spa";
        const PESQUEIRO = "pesqueiro";
        const GALPAO_LOGISTICO = "galpao_logistico";
        const MOTEL = "motel";
        const UHE = "uhe";
        const PEDREIRA = "pedreira";
        const EMPRESA = "empresa";
        const MINERIO = "minerio";
        const PEDRAS_PRECIOSAS = "pedras_preciosas";
        const REDE_DE_TELEVISAO = "rede_de_televisao";
        const HOSPITAL = "hospital";
        const LAJE_CORPORATIVA = "laje_corporativa";
        const ARMAZEM = "armazem";
        const ESCRITORIO = "escritorio";
        const VAGA_DE_GARAGEM = "vaga_de_garagem";
        const POSTO_DE_GASOLINA = "posto_de_gasolina";
        const SOBRADO_COMERCIAL = "sobrado_comercial";
        const CONDOMINIO_COMERCIAL = "condominio_comercial";
        const CONDOMINIO_INDUSTRIAL = "condominio_industrial";
        const BARRACAO_INSDUSTRIAL = "barracao_industrial";
        const CONJUNTO_INDUSTRIAL = "conjunto_industrial";
        const PREDIO_INDUSTRIAL = "predio_industrial";
        const ACADEMIA_DE_GINASTICA = "academia_de_ginastica";
        const ACOUGUE = "acougue";
        const AGENCIA_DE_EMPREGO = "agencia_de_emprego";
        const AGENCIA_DE_TURISMO = "agencia_de_turismo";
        const AUTO_ELETRICO = "auto_eletrico";
        const AVICULTURA = "avicultura";
        const BANCA_DE_JORNAL = "banca_de_jornal";
        const BOMBONIERE_ATACADO = "bomboniere_atacado";
        const BOMBONIERE_VAREJO = "bomboniere_varejo";
        const BUFFET = "buffet";
        const CAFETEIRA = "cafeteria";
        const CANTINA = "cantina";
        const CASA_DE_SUCOS = "casa_de_sucos";
        const CENTRO_AUTOMOTIVO = "centro_automotivo";
        const CHAVEIRO = "chaveiro";
        const CHOPERIA = "choperia";
        const CHURRASCARIA = "churrascaria";
        const CLINICA_DE_ESTETICA = "clinica_de_estetica";
        const COPIADORA = "copiadora";
        const DISK_PIZZA = "disk_pizza";
        const DISTRIBUIDORA_AGUA = "distribuidora_agua";
        const DISTRIBUIDORA_BEBIDAS = "distribuidora_bebidas";
        const DOCERIA = "doceria";
        const DROGARIA = "drogaria";
        const ESCOLA_DE_DANCA = "escola_de_danca";
        const ESCOLA_DE_IDIOMAS = "escola_de_idiomas";
        const ESCOLA_DE_INFORMATICA = "escoal_de_informatica";
        const ESCOLA_DE_MUSICA = "escola_de_musica";
        const ESTACIONAMENTO = "estacionamento";
        const FABRICA = "fabrica";
        const GRAFICA = "grafica";
        const JARDINAGEM = "jardinagem";
        const LATICINIOS = "laticinios";
        const LAVA_RAPIDO = "lava_rapido";
        const LAVANDERIA = "lavanderia";
        const LOJA_DE_SHOPPING = "loja_de_shopping";
        const LOTERICA = "loterica";
        const MATERIAL_DE_CONSTRUCAO = "material";
        const MERCADO = "mercado";
        const OFICINA_MECANICA = "oficina_mecanica";
        const OTICA = "otica";
        const PAPELARIA = "papelaria";
        const PETSHOP = "petshop";
        const PIZZARIA = "pizzaria";
        const PONTO_COMERCIAL = "ponto_comercial";
        const REVISTARIA = "revistaria";
        const ROTISSERIA = "retisseria";
        const SALAO_DE_CABELEREIRO = "sala_de_cabelereiro";
        const SORVETERIA = "sorveteria";
        const TRANSPORTADORA = "transportadora";
        const FLAT_COMERCIAL = "flat_comercial";
        const FRANQUIA = "franquia";
        const OUTROS = "outros";
        const PERFUMARIA = "perfumaria";
        const ADEGA = "adega";
        const ARTIGOS_RELIGIOSOS = "artigos_religiosos";
        const AUTO_PECAS = "auto_pecas";
        const BAR_NOTURNO = "bar_noturno";
        const BORRACHARIA_RODAS_E_PNEUS = "borracharia_rodas_e_pneus";
        const BRECHO = "brecho";
        const CASA_DO_NORTE = "casa_do_norte";
        const CHOCALATERIA = "chocalateria";
        const DEPOSITO_DE_GAS = "deposito_de_gas";
        const ESTACIONAMENTO_LAVA_RAPIDO = "_estacionamento_lava_rapido";
        const FABRICA_DE_DOCES_E_SALGADOS = "fabrica_de_doces_e_salgados";
        const PRODUTOS_DE_LIMPEZA = "produtos_de_limpeza";
        const FARMACIA_DE_MANIPULACAO = "farmacia_de_manipulacao";
        const FUNILARIA_E_PINTURA = "funilaria_e_pintura";
        const HAMBURGUERIA = "hamburgueria";
        const LAN_HOUSE = "lan_house";
        const LOJA_DE_ARTESANATO = "loja_de_artesanato";
        const LOJA_DE_BIJUTERIA = "loja_de_bijuteria";
        const LOJA_DE_CALCADOS = "loja_de_calcados";
        const LOJA_DE_CAMA_MESA_E_BANHO = "loja_de_cama_mesa_e_banho";
        const LOJA_DE_CELULAR = "loja_de_celular";
        const LOJA_DE_EMBALAGENS = "loja_de_embalagens";
        const LOJA_DE_INFORMATICA = "loja_de_informatica";
        const LOJA_DE_LANTERNAS_E_RETROVISORES = "loja_de_lanternas_e_retrovisores";
        const LOJA_DE_LINGERIE = "loja_de_lingerie";
        const LOJA_DE_ROUPAS = "loja_de_roupas";
        const LOJA_DE_ROUPAS_INFANTIS = "loja_De_roupas_infantis";
        const LOJA_DE_SOM_E_ACESSORIOS = "loja_de_show_e_acessorios";
        const LOJA_DE_VARIEDADES = "loja_de_variedades";
        const MADEREIRA = "madereira";
        const OFICINA_DE_COSTURA = "oficina_de_costura";
        const PASTELARIA = "pastelaria";
        const QUADRA_DE_FUTEBOL_SOCIETY = "quadra_de_futebol_society";
        const QUITANDA = "quitanda";
        const SACOLAO = "sacolao";
        const SERRALHERIA = "serralheria";
        const STUDIO_DE_TATUAGEM = "studio_de_tatuagem";
        const VIDRACARIA = "vidracaria";

        protected function getSubtypesOptions()
        {
            return [
                0 => 'loja',
                'sala_comercial',
                'galpao_comercial',
                'consultório',
                'galeria',
                'sobreloja',
                'escola',
                'lanchonete',
                'restaurante',
                'quiosque',
                'supermercado',
                'mini-Mercado',
                'padaria',
                'salao_comercial',
                'barracao_comercial',
                'conjunto_comercial',
                'pousada',
                'hotel',
                'casa_comercial',
                'industria',
                'predio_comercial',
                'galpao_industrial',
                'shopping',
                'usinas',
                'pch',
                'mineradoras',
                'jazidas',
                'spa',
                'pesqueiro',
                'galpao_logistico',
                'motel',
                'uhe',
                'pedreira',
                'empresa',
                'minerio',
                'pedras_preciosas',
                'rede_televisao',
                'hospital',
                'laje_corporativa',
                'armazem',
                'escritorio',
                'vaga_garagem',
                'posto_gasolina',
                'sobrado_comercial',
                'condominio_comercial',
                'condominio_industrial',
                'barracao_industrial',
                'conjunto_industrial',
                'predio Industrial',
                'academia_ginastica',
                'acougue',
                'agencia_emprego',
                'agencia_turismo',
                'auto_eletrico',
                'avicultura',
                'banca_jornal',
                'bomboniere_atacado',
                'bomboniere_varejo',
                'buffet',
                'cafeteria',
                'cantina',
                'casa_sucos',
                'centro_automotivo',
                'chaveiro',
                'choperia',
                'churrascaria',
                'clinica_estética',
                'copiadora',
                'disk_pizza',
                'distribuidora_agua',
                'distribuidora_bebidas',
                'doceria',
                'drograria',
                'escola_danca',
                'escola_idiomas',
                'escola_informatica',
                'escola_musica',
                'estacionamento',
                'fabrica',
                'grafica',
                'jardinagem',
                'laticínios',
                'lava_rapido',
                'lavanderia',
                'loja_shopping',
                'loterica',
                'material_construcao',
                'mercado',
                'oficina_mecenica',
                'otica',
                'papelaria',
                'petshop',
                'pizzaria',
                'ponto_comercial',
                'revistaria',
                'rotisseria',
                'salao_cabelereiro',
                'sorveteria',
                'transportadora',
                'flat_comercial',
                'franquia',
                'outros',
                'perfumaria',
                'adega',
                'artigos_religiosos',
                'auto_pecas',
                'bar_noturno',
                'borracharia_rodas_pneus',
                'brecho',
                'casa_norte',
                'chocolateria',
                'deposito_gas',
                'estacionamento_lava_rapido',
                'fabrica_doces_salgados',
                'produtos_limpeza',
                'farmacia_manipulacao',
                'funilaria_pintura',
                'hamburgueria',
                'lan_house',
                'loja_artesanato',
                'loja_bijuteria',
                'loja_calcados',
                'loja_cama_mesa_banho',
                'loja_celular',
                'loja_embalagens',
                'loja_informatica',
                'loja_lanternas_retrovisores',
                'loja_lingerie',
                'loja_roupas',
                'loja_roupas_infantis',
                'loja_som_acessorios',
                'loja_variedades',
                'madeireira',
                'oficina_costura',
                'pastelaria',
                'quadra_futebol_society',
                'quitanda',
                'sacolao',
                'serralheria',
                'studio_tatuagem',
                'vidracaria',
            ];
        }

        public function __construct($model)
        {
            $this->subtype = $this->getSubtype($model->definicao_01);

            $this->characteristics = $this->getCharacteristics($model->definicao_master);
            $this->characteristics['interna'] = $this->getInfrastructure($model->definicao_02);
        }

        protected function calculateRooms($model)
        {
            $warehouses = in_array(self::GALPAO_COMERCIAL, self::GALPAO_INDUSTRIAL, self::GALPAO_LOGISTICO);


            if (in_array($this->subtype, $warehouses)) {

                $this->right_foot = $model->salas;

                $this->rooms = $model->vagas_garagem;
                $this->bathroom = $model->vagas_garagem;
                $this->parking_lot = $model->vagas_estacionamento;

                $this->characteristics['structure'] = [
                    'docks' => $model->portas_fachadas,
                    'refectory' => $model->janelas
                ];

                return;
            }

            $this->rooms = $model->salas;
            $this->bathroom = $model->banheiros;
            $this->garage_lot = $model->vagas_garagem;
            $this->parking_lot = $model->vagas_estacionamento;
            $this->front_doors = $model->portas_fachadas;

            $this->characteristics['structure'] = [
                'windows' => $model->janelas,
            ];

        }

        public function getSubtype($options)
        {
            return $this->getSubtypesOptions()[$options]; // TODO: Change the autogenerated stub
        }


        protected function getCharacteristics($definition)
        {
            $characteristics = [];

            $characteristics['internal'] = $this->extractLabelsFlagsSci(substr($definition, 0, 34),
                $this->getCharacteristicsOptions());
            $characteristics['kitchen'] = $this->extractLabelsFlagsSci(substr($definition, 34, 34),
                $this->getCharacteristicsOptions());
            $characteristics['bathroom'] = $this->extractLabelsFlagsSci(substr($definition, 68, 34),
                $this->getCharacteristicsOptions());
            $characteristics['front'] = $this->extractLabelsFlagsSci(substr($definition, 102, 34),
                $this->getCharacteristicsOptions());
            $characteristics['more_itens'] = $this->extractLabelsFlagsSci(substr($definition, 136, 34),
                $this->getMoreCharacteristicsOptions());

            return $characteristics;
        }

        public function getInfrastructure($definition)
        {
            return $this->extractLabelsFlagsSci($definition, $this->getInfrastructureOptions());
        }

        public function getInfrastructureOptions()
        {
            return [
                'mezanino',
                'garagem',
                'estacionamento',
                'depósito',
                'copa',
                'cozinha',
                'ar Condicionado Central',
                'toldo',
                'exaustores',
                'vitrine',
                'divisórias',
                'acesso_deficientes',
                'atelier',
                'hall_social',
                'office',
                'sala_reunioes',
                'auditorio',
                'cafe',
                'restaurante',
                'piso_elevado',
                'fibra_otica',
                'Varanda',
            ];
        }

        public function getTypeName()
        {
            return 'commercial';
        }

        public function getCharacteristicsOptions()
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
    }