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
        $user->maintence_id     = $model->id;
        $user->id               = $model->id;
        $user->name             = $model->name;
        $user->email            = $model->email;
        $user->type             = 0;
        $user->status           = 0;
        $user->admission        = $model->admission;
        $user->locality         = null;
        $user->creci_number     = $model->creci;
        $user->creci_region     = $model->region;
        $user->creci_delegation = $model->delegacy;
        $user->team_id          = $model->team;
        $user->branch_id        = $model->branch;
        $user->photo            = null;
        $user->activated_at     = $model->admission;
        $user->phones           = $model->phones;
        $user->user_id          = 1;

        return $user;
    }

}
