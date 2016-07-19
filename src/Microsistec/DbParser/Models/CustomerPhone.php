<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class CustomerPhone extends Model
    {
        /**
         * @var array
         */
        protected $fillable = [
            'name',
            'source',
            'type',
            'carrier',
            'phone',
            'customer_id',
        ];

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = [];

        public function customer()
        {
            return $this->belongsTo(Customer::class);
        }
    }
