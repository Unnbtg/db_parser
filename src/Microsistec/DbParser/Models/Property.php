<?php

    namespace Microsistec\DbParser\Models;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Microsistec\DbParser\Propertify;

    /**
     * Class Property
     * @package Microsistec\DbParser\Models
     *
     * @property string $alternative_code
     * @property integer $finality
     * @property string type,
     * @property string subtype,
     * @property string for_sale,
     * @property string for_rent,
     * @property string for_vacation,
     * @property string situation,
     * @property string has_board,
     * @property string zipcode,
     * @property string state_id,
     * @property string city_id,
     * @property string neighborhood_id,
     * @property string zone,
     * @property string street,
     * @property string block,
     * @property string street_number,
     * @property string complementary,
     * @property string condominium_name,
     * @property string age,
     * @property string latitude,
     * @property string longitude,
     * @property string sell_price,
     * @property string rent_price,
     * @property string iptu_price,
     * @property string condominium_price,
     * @property string fgts,
     * @property string letter_of_credit,
     * @property string bank_financing,
     * @property string direct_financing,
     * @property string lessor_bail,
     * @property string guarantor,
     * @property string deposit,
     * @property string mcmv,
     * @property string requires_guarantor_deed,
     * @property string vacation_max,
     * @property string vacation_pets,
     * @property string vacation_parking_lots,
     * @property string keys,
     * @property string iptu_number,
     * @property string energy_number,
     * @property string water_number,
     * @property string registration_number,
     * @property string registry,
     * @property string deed_status,
     * @property string receiver1_id,
     * @property string receiver2_id,
     * @property string indicator1_id,
     * @property string indicator2_id,
     * @property string measure_unit,
     * @property string area_width,
     * @property string area_height,
     * @property string total_area,
     * @property string total_built_area,
     * @property string built_area_price,
     * @property string total_area_price,
     * @property string relative_distance,
     * @property string relative_distance_to,
     * @property string website_notes,
     * @property string notes,
     * @property string user_id,
     * @property string draft,
     */
    class Property extends Model
    {

        // use SoftDeletes

        use  Propertify;

        protected $fillable = [
            "alternative_code",
            "finality",
            "type",
            "subtype",
            "for_sale",
            "for_rent",
            "for_vacation",
            "situation",
            "has_board",
            "zipcode",
            "state_id",
            "city_id",
            "neighborhood_id",
            "zone",
            "street",
            "block",
            "street_number",
            "complementary",
            "condominium_name",
            "age",
            "latitude",
            "longitude",
            //"customer_id",
            //"alternative_customer_id",
            "sell_price",
            "rent_price",
            "iptu_price",
            "condominium_price",
            "fgts",
            "letter_of_credit",
            "bank_financing",
            "direct_financing",
            "lessor_bail",
            "guarantor",
            "deposit",
            "mcmv",
            "requires_guarantor_deed",
            "vacation_max",
            "vacation_pets",
            "vacation_parking_lots",
            "keys",
            "iptu_number",
            "energy_number",
            "water_number",
            "registration_number",
            "registry",
            "deed_status",
            "receiver1_id",
            "receiver2_id",
            "indicator1_id",
            "indicator2_id",
            "commission_proprietary_percentage",
            "commission_proprietary",
            "commission_buyer_percentage",
            "commission_buyer",
            "commission_broker_percentage",
            "commission_broker",
            "commission_team_percentage",
            "commission_team",
            "commission_receiver_percentage",
            "commission_receiver",
            "commission_indicator_percentage",
            "commission_indicator",
            "commission_estate_percentage",
            "commission_estate",
            "commission_rent_percentage",
            "commission_rent",
            "measure_unit",
            "area_width",
            "area_height",
            "total_area",
            "total_built_area",
            "built_area_price",
            "total_area_price",
            "relative_distance",
            "relative_distance_to",
            "website_home_highlight",
            "website_rotative_banner",
            "website_bank_financing",
            "website_direct_financing",
            "website_notes",
            "notes",
            "website_title",
            "website_keywords",
            "website_description",
            "user_id",
            "draft",
        ];

        public static $searchableFields = [
            "code",
            "alternative_code",
            "finality",
            "type",
            "subtype",
            "for_sale",
            "for_rent",
            "for_vacation",
            "situation",
            "has_board",
            "zipcode",
            "state_id",
            "city_id",
            "neighborhood_id",
            "zone",
            "street",
            "block",
            "street_number",
            "complementary",
            "condominium_name",
            "age",
            //"customer_id",
            //"alternative_customer_id",
            "sell_price",
            "rent_price",
            "iptu_price",
            "condominium_price",
            "fgts",
            "letter_of_credit",
            "bank_financing",
            "direct_financing",
            "lessor_bail",
            "guarantor",
            "deposit",
            "mcmv",
            "requires_guarantor_deed",
            "vacation_max",
            "vacation_pets",
            "vacation_parking_lots",
            "keys",
            "iptu_number",
            "energy_number",
            "water_number",
            "registration_number",
            "registry",
            "deed_status",
            "receiver1_id",
            "receiver2_id",
            "indicator1_id",
            "indicator2_id",
            "commission_proprietary_percentage",
            "commission_proprietary",
            "commission_buyer_percentage",
            "commission_buyer",
            "commission_broker_percentage",
            "commission_broker",
            "commission_team_percentage",
            "commission_team",
            "commission_receiver_percentage",
            "commission_receiver",
            "commission_indicator_percentage",
            "commission_indicator",
            "commission_estate_percentage",
            "commission_estate",
            "commission_rent_percentage",
            "commission_rent",
            "measure_unit",
            "area_width",
            "area_height",
            "total_area",
            "total_built_area",
            "built_area_price",
            "total_area_price",
            "relative_distance",
            "relative_distance_to",
            "website_home_highlight",
            "website_rotative_banner",
            "website_bank_financing",
            "website_direct_financing",
            "website_notes",
            "website_title",
            "website_keywords",
            "website_description",
            "notes",
            "user_id",
            "draft",
            "updated_at",
            "created_at",
        ];

        public function availabilities()
        {
            return $this->hasMany(PropertyAvailability::class);
        }

        public function getAvailabilitiesAttribute()
        {
            return $this->availabilities()->get();
        }

        public function features()
        {
            return $this->belongsToMany(Feature::class);
        }


        public function owners()
        {
            return $this->belongsToMany(Customer::class, 'properties_owners', 'property_id', 'customer_id',
                PropertyOwner::class);
        }

        public function getOwnersAttribute()
        {
            return $this->owners()->get();
        }

        public function proximities()
        {
            return $this->belongsToMany(Feature::class, 'proximity_property');
        }

        public function getProximitiesAttribute()
        {
            return $this->proximities()->get();
        }

        public function photos()
        {
            return $this->hasMany(PropertyPhoto::class)->orderBy('position', 'asc');
        }

        public function getPhotosAttribute()
        {
            return $this->photos()->get();
        }

        public function rooms()
        {
            return $this->hasMany(PropertyRoom::class);
        }

        public function videos()
        {
            return $this->hasMany(PropertyVideo::class);
        }

        public function vacations()
        {
            return $this->hasMany(PropertyVacation::class);
        }

        public function getVideosAttribute()
        {
            return $this->videos()->get();
        }

        public function documents()
        {
            return $this->hasMany(PropertyDocument::class);
        }

        public function getDocumentsAttribute()
        {
            return $this->documents()->get();
        }

        //public function customer()
        //{
        //    return $this->belongsTo(Customer::class);
        //}

        //public function alternativeCustomer()
        //{
        //    return $this->belongsTo(Customer::class, 'alternative_customer_id');
        //}

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function receiver1()
        {
            return $this->belongsTo(User::class, 'receiver1_id');
        }

        public function receiver2()
        {
            return $this->belongsTo(User::class, 'receiver2_id');
        }

        public function city()
        {
            return $this->belongsTo(City::class);
        }

        public function neighborhood()
        {
            return $this->belongsTo(Neighborhood::class);
        }

        public function getIsEditableAttribute()
        {
            $currentUser = \Auth::user();

            if ($currentUser->can('manager.properties')) {
                return true;
            }

            return $currentUser->id == $this->user_id;
        }
    }