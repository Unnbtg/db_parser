<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 20/10/17
 * Time: 14:41
 */

namespace Microsistec\DbParser\Parser\IValue;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\BuildingFeature;

class BuildingFeatureParser extends AbstractParser
{
    public function parse($model, $domain = "", $account = "")
    {
        $feature              = new BuildingFeature();
        $feature->id          = $model['id empreendimento detalhe'];
        $feature->building_id = $model['id empreendimento'];
        $feature->feature_id  = $this->features($model['detalhe']);

        return $feature;
    }

    private function features($original)
    {
        $char                         = [];
        $char['agua']                 = null;
        $char['campo_futebol']        = 9;
        $char['churrasqueira']        = 12;
        $char['elevador_privativo']   = 225;
        $char['fl_plano_minha_casa']  = null;
        $char['gourmet']              = 92;
        $char['guarita_segurança']    = 40;
        $char['jardim']               = 134;
        $char['piscina']              = 58;
        $char['piscina_adulto']       = 59;
        $char['piscina_infantil']     = 62;
        $char['playground']           = 66;
        $char['portal_eletronico']    = 69;
        $char['quadra_poliesportiva'] = 73;
        $char['recepcao_24h']         = 186;
        $char['rua_asfaltada']        = 227;
        $char['salao_festas']         = 78;
        $char['seguranca_interna']    = 246;
        $char['sistema_seguranca']    = null;
        $char['vaga_garagem']         = null;

        return isset($char[$original]) ? $char[$original] : null;
    }

}