<?php

namespace T4web\Profiler\StorageAdapter;

use T4web\Profiler\Profiler;

class NullAdapter implements StorageAdapterInterface
{
    public function save(Profiler $profiler)
    {
        return;
    }
}