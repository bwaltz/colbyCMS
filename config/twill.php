<?php

return [
    'dev_mode' => false,
    'enabled' => [
        'buckets' => true,
    ],
    'settings' => true,
    'buckets' => [
        'homepage' => [
            'name' => 'Home',
            'buckets' => [
                'home_primary_feature' => [
                    'name' => 'Home primary feature',
                    'bucketables' => [
                        [
                            'module' => 'posts',
                            'name' => 'Posts',
                            'scopes' => ['published' => true],
                        ],
                    ],
                    'max_items' => 1,
                ],
                'home_secondary_features' => [
                    'name' => 'Home secondary features',
                    'bucketables' => [
                        [
                            'module' => 'posts',
                            'name' => 'Posts',
                            'scopes' => ['published' => true],
                        ],
                    ],
                    'max_items' => 2,
                ],
            ],
        ],
    ],
    'dashboard' => [
        'modules' => [
            'pages' => [ // module name if you added a morph map entry for it, otherwise FQCN of the model (eg. App\Models\Project)
                'name' => 'pages', // module name
                'count' => true, // show total count with link to index of this module
                'create' => true, // show link in create new dropdown
                'activity' => true, // show activities on this module in actities list
                'draft' => true, // show drafts of this module for current user
                'search' => true, // show results for this module in global search,
            ],
        ],
    ],
    'frontend' => [
        'views_path' => 'frontend',
    ],
    'block_editor' => [
        'block_single_layout' => 'frontend.layouts.block',
        'block_views_path' => 'frontend.blocks',
        'blocks' => [
            'foo' => [
                'title' => 'Foo',
                'icon' => 'text',
                'component' => 'a17-block-foo',
            ],
        ],
        'directories' => [
            'source' => [
                'blocks' => [
                    [
                        'path' => resource_path('views/admin/blocks'),
                        'source' => A17\Twill\Services\Blocks\Block::SOURCE_APP,
                    ],
                ],
                'repeaters' => [
                    [
                        'path' => resource_path('views/admin/repeaters'),
                        'source' => A17\Twill\Services\Blocks\Block::SOURCE_APP,
                    ],
                ],

                'icons' => [
                    base_path('vendor/area17/twill/frontend/icons'),
                    resource_path('views/admin/icons'),
                ],
            ],

            'destination' => [
                'make_dir' => true,
                'blocks' => resource_path('views/admin/blocks'),
                'repeaters' => resource_path('views/admin/repeaters'),
            ],
        ],
    ],


];

