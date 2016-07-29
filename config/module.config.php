<?php

namespace T4web\Profiler;

return [
    'service_manager' => [
        'invokables' => [
            StorageAdapter\StorageAdapterInterface::class => StorageAdapter\NullAdapter::class,
        ]
    ]
];
