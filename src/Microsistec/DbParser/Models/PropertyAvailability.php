<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyAvailability extends Model
    {
        protected $fillable = [
            "property_id",
            "initial",
            "final",
            "reason",
            "description",
        ];
    }