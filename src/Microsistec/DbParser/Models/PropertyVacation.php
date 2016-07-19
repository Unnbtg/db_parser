<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyVacation extends Model
    {
        protected $fillable = [
            "property_id",
            "type",
            "initial",
            "final",
            "name",
            "price",
        ];
    }