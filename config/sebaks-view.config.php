<?php

namespace T4web\Profiler;

use T4web\Admin\ViewModel;

return [
    'contents' => [
        'admin-pageProfile-list' => [
            'extend' => 'admin-list',
            'data' => [
                'static' => [
                    'title' => 'Page profiles',
                    'icon' => 'fa-dashboard',
                ],
            ],
            'children' => [
                'table' => [
                    'template' => 't4web-profiler/block/table',
                    'viewModel' => ViewModel\TableViewModel::class,
                    'children' => [
                        'table-head-row' => [
                            'template' => 't4web-admin/block/table-tr',
                            'data' => [
                                'fromParent' => 'rows',
                            ],
                            'children' => [
                                'table-th-id' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Id',
                                            'width' => '5%',
                                        ],
                                    ],
                                ],
                                'table-th-date' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Date',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                                'table-th-method' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Method',
                                            'width' => '5%',
                                        ],
                                    ],
                                ],
                                'table-th-uri' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'URI',
                                            'width' => '50%',
                                        ],
                                    ],
                                ],
                                'table-th-response-code' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Response code',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                                'table-th-exec-time' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Execution time',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                                'table-th-timers' => [
                                    'template' => 't4web-admin/block/table-th',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'static' => [
                                            'value' => 'Timers',
                                            'width' => '10%',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'table-body-row' => [
                            'viewModel' => ViewModel\TableRowViewModel::class,
                            'template' => 't4web-profiler/block/table-tr',
                            'data' => [
                                'fromParent' => 'row',
                            ],
                            'children' => [
                                'table-td-id' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['id' => 'value'],
                                    ],
                                ],
                                'table-td-created' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['createdDt' => 'value'],
                                    ],
                                ],
                                'table-td-method' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['method' => 'value'],
                                    ],
                                ],
                                'table-td-uri' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['uri' => 'value'],
                                    ],
                                ],
                                'table-td-response-code' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['responseCode' => 'value'],
                                    ],
                                ],
                                'table-td-exec-time' => [
                                    'template' => 't4web-admin/block/table-td',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => ['executionTime' => 'value'],
                                    ],
                                ],
                                'table-td-timers' => [
                                    'template' => 't4web-admin/block/table-td-buttons',
                                    'capture' => 'table-td',
                                    'data' => [
                                        'fromParent' => 'id',
                                    ],
                                    'children' => [
                                        'link-button-edit' => [
                                            'viewModel' => ViewModel\EditButtonViewModel::class,
                                            'template' => 't4web-profiler/block/show-button',
                                            'capture' => 'button',
                                            'data' => [
                                                'static' => [
                                                    'text' => 'Show',
                                                    'color' => 'primary',
                                                    'size' => 'xs',
                                                    'icon' => 'search',
                                                ],
                                                'fromParent' => 'id',
                                            ],
                                        ],
                                    ]
                                ],
                            ],
                        ],
                    ],
                    'childrenDynamicLists' => [
                        'table-body-row' => 'rowsData',
                    ],
                    'data' => [
                        'static' => [
                        ],
                        'fromGlobal' => [
                            'result' => 'rowsData',
                        ],
                    ],
                ],
                'paginator' => [
                    'extend' => 't4web-admin-paginator',
                    'viewModel' => 'Profiler\PageProfile\ViewModel\PaginatorViewModel',
                ],
            ],
        ],
    ],
    'blocks' => [
        't4web-admin-sidebar-menu' => [
            'children' => [
                'profiler-menu-item' => [
                    'extend' => 't4web-admin-sidebar-menu-item',
                    'capture' => 'item',
                    'data' => [
                        'static' => [
                            'label' => 'Profiler',
                            'route' => 'admin-pageProfile-list',
                            'icon' => 'fa-dashboard',
                        ],
                    ],
                    'children' => [],
                ],
            ],
        ],
    ],
];

