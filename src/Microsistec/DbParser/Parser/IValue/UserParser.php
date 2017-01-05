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

    public function parse($model, $domain = "", $account = "")
    {
        $user = new User();

        $this->id = $user->maintence_id = $user->id = $model['id'];
        $user->admission = $this->formatDate($model['data inicio']);
        $user->email = $model['e-mail'];
        $user->name = $model['nome'];
        $user->phones[] = $this->parsePhone('home', $model['telefone']);
        $user->phones[] = $this->parsePhone('cellphone', $model['celular']);
        $user->phones[] = $this->parsePhone('home', $model['radio']);

        return $user;
    }


    public function parsePhone($type, $phone)
    {
        $uPhone = new Phone();
        $uPhone->type = $type;
        $uPhone->phone= $phone;
        $uPhone->user_id = $this->id;

        return $uPhone;

    }


}