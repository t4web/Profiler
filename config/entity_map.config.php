<?php

namespace T4web\Profiler;

return [
    'PageProfile' => [
        'entityClass' => Domain\PageProfile\PageProfile::class,
        'table' => 'profiler',
        'primaryKey' => 'id',
        'columnsAsAttributesMap' => [
            'id' => 'id',
            'method' => 'method',
            'uri' => 'uri',
            'response_code' => 'responseCode',
            'execution_time' => 'executionTime',
            'timers' => 'timers',
            'created_dt' => 'createdDt',
        ],
        'criteriaMap' => [
            'id' => 'id_equalTo',
        ]
    ],
];
