<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 19/04/18
 * Time: 15:04
 */

namespace Microsistec\DbParser\Parser\Plug7;


use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\User;

class UserParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $user                 = new User();
        $user->maintence_id   = (string)trim($model->id);
        $user->id             = (string)trim($model->id);
        $user->broker_id      = (string)trim($model->id);
        $user->code           = (string)trim($model->id);
        $user->branch_id      = null;
        $user->team_id        = null;
        $user->name           = (string)trim($model->nome);
        $user->email          = (string)trim($model->email);
        $user->type           = 0;
        $user->status         = 0;
        $user->admission      = null;
        $user->creci_delegacy = null;
        $user->creci_number   = (string)trim($model->creci);
        $user->creci_region   = null;
        $user->activated_at   = null;
        $user->phones         = $this->parsePhones($model);
        $user->user_id        = 1;
        $user->deleted_at     = $this->formatDate((string)$model->deletado);

        return $user;
    }

    protected function parsePhones($model)
    {
        $phones = [];

        if ((int)$model->tel) {
            $phone        = new \stdClass();
            $phone->phone = $this->unMask((int)$model->tel);
            $phones[]     = $phone;
        }
        if ((int)$model->radio) {
            $phone        = new \stdClass();
            $phone->phone = $this->unMask((int)$model->radio);
            $phones[]     = $phone;
        }

        return $phones;
    }
}