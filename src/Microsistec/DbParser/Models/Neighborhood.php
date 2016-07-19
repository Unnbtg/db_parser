<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class Neighborhood extends Model
    {
        protected $fillable = [
            "id",
            "name",
            "city_id",
        ];

        protected $with = ['city'];

        public $timestamps = false;

        public function city()
        {
            return $this->belongsTo(City::class);
        }
    }