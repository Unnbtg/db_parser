<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyPhoto extends Model
    {
        protected $fillable = [
            "property_id",
            "position",
            "description",
            "name",
            "path",
            "size",
            "mime",
            "width",
            "height",
        ];


    }