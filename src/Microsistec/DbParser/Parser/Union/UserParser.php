<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 19/04/18
 * Time: 15:04
 */

namespace Microsistec\DbParser\Parser\Union;


use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\User;

class UserParser extends AbstractParser implements ParserInterface
{
    // key = original, value = valor no sci
    protected $types = [
        0 => 0,
        1 => 3,
        2 => 3,
        3 => 1,
        4 => 0,
        5 => 0,
    ];

    public function parse($model, $domain = "", $account = "")
    {
        $user                 = new User();
        $user->maintence_id   = (string)trim($model->codigo);
        $user->id             = (string)trim($model->codigo);
        $user->code           = (string)trim($model->codigo);
        $user->branch_id      = null;
        $user->team_id        = null;
        $user->name           = (string)trim($model->nome);
        $user->email          = (string)trim($model->email);
        $user->type           = $this->types[(int)trim($model->permite)];
        $user->status         = 0;
        $user->admission      = null;
        $user->creci_delegacy = null;
        $user->creci_number   = (string)trim($model->creci);
        $user->creci_region   = null;
        $user->activated_at   = null;
        $user->phones         = $this->parsePhones($model);
        $user->user_id        = 1;
        $user->deleted_at     = null;

        return $user;
    }

    protected function parsePhones($model)
    {
        $phones = [];

        if ((int)$model->telefone && (int)$model->dddtelefone) {
            $phone        = new \stdClass();
            $phone->phone = (int)$model->dddtelefone . $this->unMask((int)$model->telefone);
            $phones[]     = $phone;
        }
        if ((int)$model->celular && (int)$model->dddcelular) {
            $phone        = new \stdClass();
            $phone->phone = (int)$model->dddcelular . $this->unMask((int)$model->celular);
            $phones[]     = $phone;
        }

        return $phones;
    }
}