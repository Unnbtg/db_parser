<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 22/12/16
 * Time: 13:39
 */

namespace Microsistec\DbParser\Parser\IValue;

use Microsistec\DbParser\Phone;
use Microsistec\DbParser\User;

class UserParser extends AbstractParser
{
    protected $id;

    protected $status = [
        ['id' => 0, 'name' => 'ativo'],
        ['id' => 1, 'name' => 'inativo'],
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $this->id = (int)$model['id'];

        $user                 = new User();
        $user->maintence_id   = (int)$model['id'];
        $user->id             = (int)$model['id'];
        $user->broker_id      = (int)$model['id'];
        $user->name           = $model['nome completo'];
        $user->photo          = $model['url foto'] ?: null;
        $user->email          = $model['e-mail'];
        $user->password       = null;
        $user->type           = 0;
        $user->status         = $this->getFromComplexConfig(strtolower($model['status']), $this->status);
        $user->admission      = $this->formatDate($model['data inicio']) ?: null;
        $user->locality       = null;
        $user->creci_number   = $model['creci'] ?: null;
        $user->creci_region   = null;
        $user->creci_delegacy = null;
        $user->team_id        = null;
        $user->branch_id      = null;
        $user->created_at     = $this->formatDate($model['data cadastro']) ?: null;
        $user->phones[]       = $this->parsePhone('home', $model['telefone']);
        $user->phones[]       = $this->parsePhone('cellphone', $model['celular']);
        $user->phones[]       = $this->parsePhone('home', $model['radio']);
        $user->user_id        = 1;

        return $user;
    }

    public function parsePhone($type, $phone)
    {
        $uPhone        = new Phone();
        $uPhone->type  = $type;
        $uPhone->phone = $this->unMask($phone);

        return $uPhone;

    }
}
