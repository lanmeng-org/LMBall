<?php

return [
    '主功能' => [
        'permission' => null,
        'role' => null,

        'menu' => [

            '用户管理' => [
                'icon' => 'fa fa-users',
                'url' => '#',

                'sub_menu' => [
                    '用户管理' => [
                        'url' => 'admin/rbac/user',
                    ],

                    '角色管理' => [
                        'url'  => 'admin/rbac/role',
                    ],

                    '权限管理' => [
                        'url'  => 'admin/rbac/permission',
                    ],

                    '路由权限' => [
                        'url'  => 'admin/rbac/route',
                    ],
                ],
            ],

        ],
    ],
];
