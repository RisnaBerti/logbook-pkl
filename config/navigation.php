<?php

$nav = [
    "navbar" => [
        [
            "title" => "Master Data",
            "icon" => '<i class="menu-icon tf-icons bx bx-briefcase"></i>',
            "group" => "",
            "submenus" => [
                [
                    "title" => "Keterampilan",
                    "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
                    "group" => "",
                    "route" => 'keterampilan.index',
                    "permissions" => ["keterampilan view"],
                ],
                [
                    "title" => "Sekolah",
                    "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
                    "group" => "",
                    "route" => 'sekolah.index',
                    "permissions" => ["sekolah view"],
                ],
                [
                    "title" => "Periode PKL",
                    "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
                    "group" => "",
                    "route" => 'periode-pkl.index',
                    "permissions" => ["periode-pkl view"],
                ],
                
            ],
        ],
        [
            "title" => "Mentor",
            "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
            "group" => "",
            "route" => 'mentor.index',
            "permissions" => ["mentor view"],
        ],
        [
            "title" => "Anak PKL",
            "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
            "group" => "",
            "route" => 'anak-pkl.index',
            "permissions" => ["anak-pkl view"],
        ],  
        [
            "title" => "Sertifikat",
            "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
            "group" => "",
            "route" => 'sertifikat.index',
            "permissions" => ["sertifikat view"],
        ],
        [
            "title" => "Jurnal PKL",
            "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
            "group" => "",
            "route" => 'jurnal.index',
            "permissions" => ["jurnal view"],
        ],
        [
            "title" => "Feedback",
            "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
            "group" => "",
            "route" => 'feedback.index',
            "permissions" => ["feedback view"],
        ],
        [
            "title" => "Penilaian",
            "icon" => '<i class="menu-icon tf-icons bx bx-receipt"></i>',
            "group" => "",
            "route" => 'penilaian.index',
            "permissions" => ["penilaian view"],
        ],
        
        [
            "title" => "Manajemen Users",
            "icon" => '<i class="menu-icon tf-icons bx bx-lock-open-alt"></i>',
            "group" => "Misc",
            "submenus" => [
                [
                    'title' => 'Users',
                    'route' => 'users.index',
                    // 'route' => null,
                    'permissions' => ['user view']
                ],
                [
                    'title' => 'Roles',
                    'route' => 'roles.index',
                    // 'route' => null,
                    'permissions' => ['role & permission view']
                ],
                // [
                //     'title' => 'Permissions',
                //     // 'route' => 'permissions.index',
                //     'route' => null,
                //     'permissions' => ['role & permission view']
                // ]
            ],
        ]
    ],
];

return $nav;
