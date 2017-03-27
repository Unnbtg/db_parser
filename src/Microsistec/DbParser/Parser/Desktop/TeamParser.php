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
        $team->maintence_id = $model->id;
        $team->id           = $model->id;
        $team->name         = $model->name;
        $team->status       = $model->status;
        $team->user_id      = 1;

        return $team;
    }

}
