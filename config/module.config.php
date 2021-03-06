<?php

namespace T4web\Profiler;

return [
    'sebaks-view' => include 'sebaks-view.config.php',
    'entity_map' => include 'entity_map.config.php',
    't4web-crud' => include 't4web-crud.config.php',
    't4web-profiler' => [
        'profiling-timeout' => 500, // in ms
        'use-default-listeners' => true,
    ],

    'service_manager' => [
        'factories' => [
            StorageAdapter\StorageAdapterInterface::class => StorageAdapter\NullAdapterFactory::class,
        ]
    ],

    'console' => [
        'router' => [
            'routes' => [
                'profiler-init' => [
                    'type' => 'simple',
                    'options' => [
                        'route' => 'profiler init',
                        'defaults' => [
                            'controller' => Controller\InitController::class,
                        ]
                    ]
                ],
            ],
        ],
    ],

    'controllers' => [
        'factories' => [
            Controller\InitController::class => Controller\InitControllerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
