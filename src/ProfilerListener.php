<?php

namespace T4web\Profiler;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface as Events;
use Zend\Mvc\MvcEvent;
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
    }

    public function onFinish(MvcEvent $mvcEvent)
    {
        $this->profiler->collect($mvcEvent);
        $this->storage->save($this->profiler);
    }
}
