<?php

namespace T4web\Profiler;

use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventInterface;
use Zend\Http\PhpEnvironment\Request;
use Zend\ModuleManager\Exception\MissingDependencyModuleException;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(EventInterface $e)
    {
        /** @var ModuleManager $moduleManager */
        $moduleManager = $e->getApplication()
            ->getServiceManager()
            ->get('modulemanager');

        if (!$moduleManager->getModule('T4web\\DefaultService')) {
            throw new MissingDependencyModuleException('Module "T4web\\DefaultService" must be enabled in your
                config/application.config.php. For details see https://github.com/t4web/Profiler#post-installation.');
        }

        /** @var EventManager $eventManager */
        $eventManager = $e->getApplication()->getEventManager();

        $eventManager->attach(MvcEvent::EVENT_ROUTE, function(EventInterface $e) {
            /** @var Request $request */
            $request = $e->getRequest();

            if (! $request instanceof Request) {
                return;
            }

            die(var_dump(__METHOD__));
        }, -1000);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src',
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include dirname(__DIR__) . '/config/module.config.php';
    }
}

