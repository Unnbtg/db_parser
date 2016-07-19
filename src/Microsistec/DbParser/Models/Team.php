<?php

    namespace Microsistec\DbParser\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'status'
    ];
}
