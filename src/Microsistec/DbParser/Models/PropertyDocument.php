<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyDocument extends Model
    {
        protected $fillable = [
            "name",
            "filename",
            "property_id",
        ];
    }