<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class CustomerNote extends Model
    {
        /**
         * @var array
         */
        protected $fillable = [
            'body',
            'customer_id',
        ];

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = [];
    }
