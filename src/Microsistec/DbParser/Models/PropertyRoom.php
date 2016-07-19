<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyRoom extends Model
    {
        protected $fillable = [
            "property_id",
            "type",
            "name",
        ];

        public function features()
        {
            return $this->belongsToMany(Feature::class);
        }

        public function property()
        {
            return $this->belongsTo(Property::class);
        }
    }