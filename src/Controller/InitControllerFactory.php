<?php

namespace T4web\Profiler\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InitControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $serviceLocator = $controllerManager->getServiceLocator();

        return new InitController(
            $serviceLocator->get('Zend\Db\Adapter\Adapter')
        );
    }
}
