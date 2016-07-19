<?php

    namespace Microsistec\DbParser\Models;

    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Feature
     * @package App\Models
     * @method static Builder forProperty()
     * @see     Feature::scopeForProperty
     * @method static Builder forRoom()
     * @see     Feature::scopeForRoom
     * @method static Builder forProximities()
     * @see     Feature::scopeForProximities
     */
    class Feature extends Model
    {
        protected $fillable = [
            "type",
            "alias",
            "name",
            "relative",
            "user_id",
        ];

        protected $hidden = [
            "created_at",
            "updated_at",
            "user_id",
            "type",
        ];

        public function properties()
        {
            return $this->belongsToMany(Property::class);
        }

        public function rooms()
        {
            return $this->belongsToMany(PropertyRoom::class);
        }

        public function scopeForProperty(Builder $query)
        {
            return $query->where('type', '=', 1);
        }

        public function scopeForRoom(Builder $query)
        {
            return $query->where('type', '=', 2);
        }

        public function scopeForProximities(Builder $query)
        {
            return $query->where('type', '=', 3);
        }
    }