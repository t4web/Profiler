<?php

namespace T4web\Profiler;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface as Events;
use Zend\Mvc\MvcEvent;
use Zend\Console\Request as ConsoleRequest;
use T4web\Profiler\StorageAdapter\StorageAdapterInterface;

class ProfilerListener extends AbstractListenerAggregate
{
    /**
     * @var Profiler
     */
    protected $profiler;

    /**
     * @var StorageAdapterInterface
     */
    protected $storage;

    public function __construct(Profiler $profiler, StorageAdapterInterface $storage)
    {
        $this->profiler = $profiler;
        $this->storage = $storage;
    }

    public function attach(Events $events)
    {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_FINISH, [$this, 'onFinish'], -9999);

        $profiler = $this->profiler;

        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_ROUTE,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->startTimer(MvcEvent::EVENT_ROUTE);
            },
            9999
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_ROUTE,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->endTimer(MvcEvent::EVENT_ROUTE);
            },
            -9999
        );

        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->startTimer(MvcEvent::EVENT_DISPATCH);
            },
            9999
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_DISPATCH,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->endTimer(MvcEvent::EVENT_DISPATCH);
            },
            -9999
        );

        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->startTimer(MvcEvent::EVENT_RENDER);
            },
            9999
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->endTimer(MvcEvent::EVENT_RENDER);
            },
            -9999
        );

        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_FINISH,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->startTimer(MvcEvent::EVENT_FINISH);
            },
            9999
        );
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_FINISH,
            function(MvcEvent $mvcEvent) use ($profiler) {
                $profiler->endTimer(MvcEvent::EVENT_FINISH);
            },
            -9999
        );
    }

    public function onFinish(MvcEvent $mvcEvent)
    {
        if ($mvcEvent->getRequest() instanceof ConsoleRequest) {
            return;
        }

        $this->profiler->collect($mvcEvent);

        if ($this->profiler->needStore()) {
            $this->storage->save($this->profiler);
        }
    }
}
