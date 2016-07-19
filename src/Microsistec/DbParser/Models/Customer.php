<?php

    namespace Microsistec\DbParser\Models;
    use Illuminate\Database\Eloquent\SoftDeletes;

    /**
     *
     * @property mixed id                        magic property
     * @property mixed name                      magic property
     * @property mixed user_id                   magic property
     * @property mixed cpf                       magic property
     * @property mixed street                    magic property
     * @property mixed street_number             magic property
     * @property mixed complementary             magic property
     * @property mixed neighborhood_id           magic property
     * @property mixed city_id                   magic property
     * @property mixed state_id                  magic property
     * @property mixed zipcode                   magic property
     * @property mixed rg                        magic property
     * @property mixed rg_issuer                 magic property
     * @property mixed rg_issued_at              magic property
     * @property mixed birthdate                 magic property
     * @property mixed marital_status            magic property
     * @property mixed occupation                magic property
     * @property mixed nationality               magic property
     * @property mixed naturalness               magic property
     * @property mixed paternal_filiation        magic property
     * @property mixed maternal_filiation        magic property
     * @property mixed spouse_name               magic property
     * @property mixed spouse_cpf                magic property
     * @property mixed spouse_rg                 magic property
     * @property mixed spouse_rg_issuer          magic property
     * @property mixed spouse_rg_issued_at       magic property
     * @property mixed spouse_birthdate          magic property
     * @property mixed spouse_marital_status     magic property
     * @property mixed spouse_occupation         magic property
     * @property mixed spouse_nationality        magic property
     * @property mixed spouse_naturalness        magic property
     * @property mixed spouse_paternal_filiation magic property
     * @property mixed spouse_maternal_filiation magic property
     * @property mixed union_date                magic property
     * @property mixed union_security            magic property
     * @property mixed income                    magic property
     * @property mixed bank_name                 magic property
     * @property mixed bank_agency               magic property
     * @property mixed bank_account              magic property
     * @property mixed created_at                magic property
     * @property mixed updated_at                magic property
     * @property mixed deleted_at                magic property
     * @property mixed phone                     magic accessor
     * @property mixed email                     magic accessor
     *
     */
    class Customer extends Model
    {
        use SoftDeletes;

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'cpf',
            'street',
            'street_number',
            'complementary',
            'zipcode',
            "state_id",
            "city_id",
            "neighborhood_id",
            'rg',
            'rg_issuer',
            'rg_issued_at',
            'birthdate',
            'marital_status',
            'occupation',
            'nationality',
            'naturalness',
            'paternal_filiation',
            'maternal_filiation',
            'spouse_name',
            'spouse_cpf',
            'spouse_rg',
            'spouse_rg_issuer',
            'spouse_rg_issued_at',
            'spouse_birthdate',
            'spouse_marital_status',
            'spouse_occupation',
            'spouse_nationality',
            'spouse_naturalness',
            'spouse_paternal_filiation',
            'spouse_maternal_filiation',
            'union_date',
            'union_security',
            'income',
            'bank_name',
            'bank_agency',
            'bank_account',
            'user_id',
        ];

        protected $appends = ['phone', 'email'];

        /**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = [];

        public function emails()
        {
            return $this->hasMany(CustomerEmail::class);
        }

        public function phones()
        {
            return $this->hasMany(CustomerPhone::class);
        }

        public function notes()
        {
            return $this->hasMany(CustomerNote::class);
        }

        public function properties()
        {
            return $this->belongsToMany(Property::class, 'properties_owners', 'customer_id', 'property_id',
                PropertyOwner::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function getPhoneAttribute()
        {
            $phone = $this->phones()->first();
            if ( ! $phone) {
                return null;
            }

            return $phone->phone;
        }

        public function getEmailAttribute()
        {
            $email = $this->emails()->orderBy('default', 'DESC')->first();
            if ( ! $email) {
                return null;
            }

            return $email->email;
        }


        public function city()
        {
            return $this->belongsTo(City::class);
        }

        public function neighborhood()
        {
            return $this->belongsTo(Neighborhood::class);
        }

    }
