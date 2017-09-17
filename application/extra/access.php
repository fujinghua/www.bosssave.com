<?php

// 权限控制
return [
    // 默认角色(开放角色)
    'default_role'                   => ['0','1'],
    // 默认权限(开放权限)
    'default_action'                 => [
        '/back/*',
        '/back/*',
        '/back/auth/*',
        '/back/index/*',
        '/back/login/*',
        '/back/ajax/*',
        '/back/city/*',
    ],
];
