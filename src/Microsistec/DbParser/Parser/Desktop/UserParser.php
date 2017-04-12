<?php

namespace Microsistec\DbParser\Parser\Desktop;

use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\User;

class UserParser extends ParserAbstract implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $user                   = new User();
        $user->maintence_id     = (int)$model->id;
        $user->id               = (int)$model->id;
        $user->code             = (int)$model->code;
        $user->branch_id        = (int)$model->branch_id;
        $user->team_id          = (int)$model->team_id;
        $user->name             = $model->name;
        $user->email            = $model->email;
        $user->type             = 0;
        $user->status           = 0;
        $user->admission        = $this->formatDate($model->admission);
        $user->creci_delegacy   = $model->delegacy;
        $user->creci_number     = $model->creci;
        $user->creci_region     = $model->region;
        $user->activated_at     = $this->formatDate($model->admission);
        $user->phones           = $this->parsePhones($model->phones);
        $user->user_id          = 1;
        $user->deleted_at       = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;

        $encodedUser = new User();

        foreach ($user as $key => $value) {

            $encodedUser->{$key} = $value !== '' ? $value : null;

            if (!empty($value) && is_scalar($value)) {

                if(!is_int($value)) {
                    $encodedUser->{$key} = utf8_encode(utf8_decode($value));
                }

                continue;
            }


        }

        return $encodedUser;
    }

}
