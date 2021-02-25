<?php

return [
    'pages' => [
        'title' => 'Pages',
        'module' => true,
    ],
    'posts' => [
        'title'     => 'Posts',
        'module'    => true
    ],
    'categories' => [
        'title' => 'Categories',
        'module' => true
    ],
    'featured' => [
        'title' => 'Features',
        'route' => 'admin.featured.homepage',
        'primary_navigation' => [
            'homepage' => [
                'title' => 'Homepage',
                'route' => 'admin.featured.homepage',
            ],
        ],
    ],
    'customPage' => [
        'title' => 'Custom Page',
        'route' => 'admin.customPage',
    ],
    'settings' => [
        'title' => 'Settings',
        'route' => 'admin.settings',
        'params' => ['section' => 'site'],
        'primary_navigation' => [
            'site' => [
                'title' => 'Site',
                'route' => 'admin.settings',
                'params' => ['section' => 'contentFields']
            ],
        ]
    ],
];
