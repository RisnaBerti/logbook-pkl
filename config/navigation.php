<?php

$nav = [
    "navbar" => [
        [
            "title" => "Master Data",
            "icon" => '<i class="menu-icon tf-icons bx bx-data"></i>',
            "group" => "",
            "submenus" => [
                [
                    "title" => "Keterampilan",
                    "icon" => '<i class="menu-icon tf-icons bx bx-task"></i>',
                    "group" => "",
                    "route" => 'keterampilan.index',
                    "permissions" => ["keterampilan view"],
                ],
                [
                    "title" => "Sekolah",
                    "icon" => '<i class="menu-icon tf-icons bx bx-school"></i>',
                    "group" => "",
                    "route" => 'sekolah.index',
                    "permissions" => ["sekolah view"],
                ],
                [
                    "title" => "Periode PKL",
                    "icon" => '<i class="menu-icon tf-icons bx bx-calendar"></i>',
                    "group" => "",
                    "route" => 'periode-pkl.index',
                    "permissions" => ["periode-pkl view"],
                ],
            ],
        ],
        [
            "title" => "Pendampingan",
            "icon" => '<i class="menu-icon tf-icons bx bx-user-voice"></i>',
            "group" => "",
            "submenus" => [
                [
                    "title" => "Mentor",
                    "icon" => '<i class="menu-icon tf-icons bx bx-user"></i>',
                    "route" => 'mentor.index',
                    "permissions" => ["mentor view"],
                ],
                [
                    "title" => "Anak PKL",
                    "icon" => '<i class="menu-icon tf-icons bx bx-group"></i>',
                    "route" => 'anak-pkl.index',
                    "permissions" => ["anak-pkl view"],
                ],
            ],
        ],
        // [
        //     "title" => "Penilaian",
        //     "icon" => '<i class="menu-icon tf-icons bx bx-pencil"></i>',
        //     "group" => "",
        //     "submenus" => [
        //         [
        //             "title" => "Penilaian",
        //             "icon" => '<i class="menu-icon tf-icons bx bx-check-circle"></i>',
        //             "route" => 'penilaian.index',
        //             "permissions" => ["penilaian view"],
        //         ],
        // [
        //     "title" => "Sertifikat",
        //     "icon" => '<i class="menu-icon tf-icons bx bx-award"></i>',
        //     "route" => 'sertifikat.index',
        //     "permissions" => ["sertifikat view"],
        // ],
        //     ],
        // ],
        [
            "title" => "Penilaian",
            "icon" => '<i class="menu-icon tf-icons bx bx-award"></i>',
            "route" => 'penilaian.index',
            "group" => "",
            "permissions" => ["penilaian view"],
        ],
        [
            "title" => "Jurnal",
            "icon" => '<i class="menu-icon tf-icons bx bx-book"></i>',
            "group" => "",
            "route" => 'jurnal.index',
            "permissions" => ["jurnal view"],
        ],
        [
            "title" => "Mentoring",
            "icon" => '<i class="menu-icon tf-icons bx bx-chalkboard"></i>',
            "group" => "",
            "route" => 'riwayat-mentoring.index',
            "permissions" => ["riwayat-mentoring view"],
        ],
        [
            "title" => "Laporan",
            "icon" => '<i class="menu-icon tf-icons bx bx-file"></i>',
            "group" => "",
            "submenus" => [
                [
                    'title' => 'Laporan Jurnal',
                    "icon" => '<i class="menu-icon tf-icons bx bx-file"></i>',
                    "route" => 'laporan.jurnal',
                    "permissions" => ["laporan jurnal view"],
                ],
                [
                    'title' => 'Laporan Mentoring',
                    "icon" => '<i class="menu-icon tf-icons bx bx-file"></i>',
                    "route" => 'laporan.mentoring',
                    "permissions" => ["laporan mentoring view"],
                ],
                [
                    'title' => 'Rekap Jurnal',
                    "icon" => '<i class="menu-icon tf-icons bx bx-spreadsheet"></i>',
                    "route" => 'rekap.jurnal',
                    "permissions" => ["rekap jurnal view"],
                ],
            ],
        ],
        [
            "title" => "Manajemen Users",
            "icon" => '<i class="menu-icon tf-icons bx bx-user-circle"></i>',
            "group" => "Misc",
            "submenus" => [
                [
                    'title' => 'Users',
                    'icon' => '<i class="menu-icon tf-icons bx bx-user"></i>',
                    'route' => 'users.index',
                    'permissions' => ['user view']
                ],
                [
                    'title' => 'Roles',
                    'icon' => '<i class="menu-icon tf-icons bx bx-lock-alt"></i>',
                    'route' => 'roles.index',
                    'permissions' => ['role & permission view']
                ],
            ],
        ]
    ],
];

return $nav;
