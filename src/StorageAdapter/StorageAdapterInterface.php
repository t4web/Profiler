<?php

namespace T4web\Profiler\StorageAdapter;

use T4web\Profiler\Profiler;

interface StorageAdapterInterface
{
    public function save(Profiler $profiler);
}