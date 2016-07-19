<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Model;

    class PropertyRoomFeature extends Model
    {
        protected $fillable = [
            "property_room_id",
            "feature_id",
        ];
    }