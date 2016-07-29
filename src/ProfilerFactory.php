<?php

namespace T4web\Profiler;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProfilerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $config = $serviceManager->get('Config');
        return new Profiler($config['t4web-profiler']['profiling-timeout']);
    }
}
