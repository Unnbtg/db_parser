<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class SessionLog extends Model
    {
        protected $fillable = [
            'code',
            'details',
            'oauth_session_id',
        ];
    }
