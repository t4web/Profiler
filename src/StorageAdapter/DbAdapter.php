<?php

namespace T4web\Profiler\StorageAdapter;

use Zend\Db\Adapter\Adapter;
use T4web\Profiler\Profiler;

class DbAdapter implements StorageAdapterInterface
{
    /**
     * @var Adapter
     */
    protected $dbAdapter;

    public function __construct(Adapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function save(Profiler $profiler)
    {
        $profile = $profiler->toArray();

        $this->dbAdapter->query(
            "INSERT INTO profiler (`method`, `uri`, `responce_code`, `execution_time`, `timers`) VALUES (?, ?, ?, ?, ?)",
            [
                $profile['method'],
                $profile['uri'],
                $profile['responseCode'],
                round($profile['execution_time'] * 1000),
                json_encode($profile['timers']),
            ]
        );
    }
}