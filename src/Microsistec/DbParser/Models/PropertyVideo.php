<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyVideo extends Model
    {
        protected $fillable = [
            "url",
            "property_id",
        ];
    }