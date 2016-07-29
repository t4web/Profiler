<?php

namespace T4web\Profiler;

use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Exception\MissingDependencyModuleException;
use Zend\Console\Adapter\AdapterInterface;

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

        $profilerListener = $e->getApplication()
            ->getServiceManager()
            ->get(ProfilerListener::class);
        $eventManager->attach($profilerListener);
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

    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            'Initialize prrofiler',
            'profiler init' => 'Check config, create table `proliler`',
        ];
    }
}

