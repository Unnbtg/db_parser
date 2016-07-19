<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyFeature extends Model
    {
        protected $fillable = [
            "property_id",
            "feature_id",
        ];
    }