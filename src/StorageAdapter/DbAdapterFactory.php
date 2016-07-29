<?php

namespace T4web\Profiler\StorageAdapter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DbAdapterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        return new DbAdapter(
            $serviceManager->get('Zend\Db\Adapter\Adapter')
        );
    }
}
