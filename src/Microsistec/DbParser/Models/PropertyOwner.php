<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyOwner extends Model
    {
        protected $table = "properties_owners";

        protected $fillable = [
            "property_id",
            "customer_id",
        ];
    }