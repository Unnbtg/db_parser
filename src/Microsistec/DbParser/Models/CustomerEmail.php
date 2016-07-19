<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class CustomerEmail extends Model
    {
        /**
         * @var array
         */
        protected $fillable = [
            'email',
            'default',
            'customer_id',
        ];

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = [];
    }
