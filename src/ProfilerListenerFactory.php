<?php

namespace T4web\Profiler;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4web\Profiler\StorageAdapter\StorageAdapterInterface;

class ProfilerListenerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        return new ProfilerListener(
            $serviceManager->get(Profiler::class),
            $serviceManager->get(StorageAdapterInterface::class)
        );
    }
}
