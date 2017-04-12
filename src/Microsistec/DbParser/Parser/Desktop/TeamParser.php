<?php

namespace Microsistec\DbParser\Parser\Desktop;

use Microsistec\DbParser\Parser\ParserAbstract;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Team;

class TeamParser extends ParserAbstract implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $team               = new Team();
        $team->maintence_id = (int)$model->id;
        $team->id           = (int)$model->id;
        $team->code         = (int)$model->code;
        $team->branch_id    = (int)$model->branch_id;
        $team->name         = $model->name;
        $team->status       = (int)$model->status;
        $team->user_id      = 1;
        $team->deleted_at   = ($model->deleted == true) ? date('Y-m-d H:i:s') : null;

        return $team;
    }

}
