<?php
    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class City extends Model
    {
        protected $fillable = [
            "id",
            "name",
            "state_id",
        ];

        protected $appends = [
            'state',
        ];

        public $timestamps = false;


        public function neighborhoods()
        {
            return $this->hasMany(Neighborhood::class);
        }
    }