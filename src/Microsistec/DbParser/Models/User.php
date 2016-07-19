<?php

    namespace Microsistec\DbParser\Models;
    /**
     * @property UserSettings $settings
     */
    class User
    {
        protected $fillable = [
            'name',
            'email',
            'password',
        ];

        const TYPE_BROKER = 0;
        const TYPE_SECRETARY = 1;
        const TYPE_MANAGER = 2;

        /**
         * Esses tipos não são o mesmo que grupos de permissões
         * eles existem só para criar uma "label" para cada
         * usuário
         */
        protected static $types = [
            self::TYPE_BROKER    => "Corretor",
            self::TYPE_SECRETARY => "Secretaria",
            self::TYPE_MANAGER   => "Gerente",
        ];

        protected $hidden = [
            'password',
            'remember_token',
            'roles',
            'permissions',
        ];

        public function buildPermissionsTree()
        {
            $originalPermissions = $this->getPermissions();
            $permissions = [];

            // "flattenifica" a array padrão do laravel-acl
            // para o frontend poder ler com mais facilidade
            // e sem ter que criar uma biblioteca todinha só
            // pra isso
            foreach ($originalPermissions as $permissionName => $permissionAliases) {
                foreach ($permissionAliases as $key => $value) {
                    $permissions["$key.$permissionName"] = $value;
                }
            }

            return $permissions;
        }

        public function getGuardAttribute()
        {
            return $this->buildPermissionsTree();
        }

        public static function getTypes()
        {
            return self::$types;
        }

        public function getSettingsAttribute()
        {
            return new UserSettings($this);
        }
    }
