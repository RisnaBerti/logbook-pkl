<?php

return [

    'models' => [

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Permission" model but you may use whatever you like.
         *
         * The model you want to use as a Permission model needs to implement the
         * `Spatie\Permission\Contracts\Permission` contract.
         */

        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Role" model but you may use whatever you like.
         *
         * The model you want to use as a Role model needs to implement the
         * `Spatie\Permission\Contracts\Role` contract.
         */

        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'roles' => 'roles',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your permissions. We have chosen a basic
         * default value but you may easily change it to any table you like.
         */

        'permissions' => 'permissions',

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * table should be used to retrieve your models permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_permissions' => 'model_has_permissions',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your models roles. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'model_has_roles' => 'model_has_roles',

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * table should be used to retrieve your roles permissions. We have chosen a
         * basic default value but you may easily change it to any table you like.
         */

        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related pivots other than defaults
         */
        'role_pivot_key' => null, //default 'role_id',
        'permission_pivot_key' => null, //default 'permission_id',

        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',

        /*
         * Change this if you want to use the teams feature and your related model's
         * foreign key is other than `team_id`.
         */

        'team_foreign_key' => 'team_id',
    ],

    /*
     * When set to true, the method for checking permissions will be registered on the gate.
     * Set this to false if you want to implement custom logic for checking permissions.
     */

    'register_permission_check_method' => true,

    /*
     * When set to true, Laravel\Octane\Events\OperationTerminated event listener will be registered
     * this will refresh permissions on every TickTerminated, TaskTerminated and RequestTerminated
     * NOTE: This should not be needed in most cases, but an Octane/Vapor combination benefited from it.
     */
    'register_octane_reset_listener' => false,

    /*
     * Teams Feature.
     * When set to true the package implements teams using the 'team_foreign_key'.
     * If you want the migrations to register the 'team_foreign_key', you must
     * set this to true before doing the migration.
     * If you already did the migration then you must make a new migration to also
     * add 'team_foreign_key' to 'roles', 'model_has_roles', and 'model_has_permissions'
     * (view the latest version of this package's migration file)
     */

    'teams' => false,

    /*
     * Passport Client Credentials Grant
     * When set to true the package will use Passports Client to check permissions
     */

    'use_passport_client_credentials' => false,

    /*
     * When set to true, the required permission names are added to exception messages.
     * This could be considered an information leak in some contexts, so the default
     * setting is false here for optimum safety.
     */

    'display_permission_in_exception' => false,

    /*
     * When set to true, the required role names are added to exception messages.
     * This could be considered an information leak in some contexts, so the default
     * setting is false here for optimum safety.
     */

    'display_role_in_exception' => false,

    /*
     * By default wildcard permission lookups are disabled.
     * See documentation to understand supported syntax.
     */

    'enable_wildcard_permission' => false,

    /*
     * The class to use for interpreting wildcard permissions.
     * If you need to modify delimiters, override the class and specify its name here.
     */
    // 'permission.wildcard_permission' => Spatie\Permission\WildcardPermission::class,

    /* Cache-specific settings */

    'cache' => [

        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'spatie.permission.cache',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],

    'permissions' => [
        [
            'group' => 'users',
            'pengguna' => ['admin'],
            'access' => [
                'user change-password',
                // 'user forgot-password',
                'user profile',
                'user view',
                'user create',
                'user edit',
                'user delete',
                'user change-password-admin', // untuk ganti password spesifik user
            ]
        ],
        [
            'group' => 'roles & permissions',
            'pengguna' => ['admin'],
            'access' => [
                'role & permission view',
                'role & permission create',
                'role & permission edit',
                'role & permission delete',
            ]
        ],
        [
            'group' => 'mentor',
            'access' => [
                'mentor view',
                'mentor create',
                'mentor edit',
                'mentor delete',
            ]
        ],
        [
            'group' => 'anak-pkl',
            'access' => [
                'anak-pkl view',
                'anak-pkl create',
                'anak-pkl edit',
                'anak-pkl delete',
            ]
        ],
        [
            'group' => 'sekolah',
            'access' => [
                'sekolah view',
                'sekolah create',
                'sekolah edit',
                'sekolah delete',
            ]
        ],
        [
            'group' => 'keterampilan',
            'access' => [
                'keterampilan view',
                'keterampilan create',
                'keterampilan edit',
                'keterampilan delete',
            ]
        ],
        [
            'group' => 'penilaian',
            'access' => [
                'penilaian view',
                'penilaian create',
                'penilaian edit',
                'penilaian delete',
            ]
        ],
        [
            'group' => 'detail penilaian',
            'access' => [
                'detail-penilaian view',
                'detail-penilaian create',
                'detail-penilaian edit',
                'detail-penilaian delete',
            ]
        ],
        [
            'group' => 'jurnal',
            'access' => [
                'jurnal view',
                'jurnal create',
                'jurnal edit',
                'jurnal delete',
            ]
        ],
        [
            'group' => 'feedback',
            'access' => [
                'feedback view',
                'feedback create',
                'feedback edit',
                'feedback delete',
            ]
        ],
        [
            'group' => 'periode-pkl',
            'access' => [
                'periode-pkl view',
                'periode-pkl create',
                'periode-pkl edit',
                'periode-pkl delete',
            ]
        ],
        [
            'group' => 'sertifikat',
            'access' => [
                'sertifikat view',
                'sertifikat create',
                'sertifikat edit',
                'sertifikat delete',
            ]
        ],
        [
            'group' => 'riwayat-mentoring',
            'access' => [
                'riwayat-mentoring view',
                'riwayat-mentoring create',
                'riwayat-mentoring edit',
                'riwayat-mentoring delete',
            ]
        ],
        [
            'group' => 'detail-mentoring',
            'access' => [
                'detail-mentoring view',
                'detail-mentoring create',
                'detail-mentoring edit',
                'detail-mentoring delete',
            ]
        ],
        [
            'group' => 'laporan',
            'access' => [
                'laporan jurnal view',
                'laporan jurnal download',
                'rekap jurnal view',
                'laporan mentoring view',
            ]
        ],
    ]
];
