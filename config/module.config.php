<?php

namespace T4web\Profiler;

return [
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
];
