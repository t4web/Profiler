<?php

namespace T4web\Profiler;

use Zend\Mvc\MvcEvent;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;

class Profiler
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var array
     */
    protected $memoryMark;

    public function collect(MvcEvent $mvcEvent)
    {
        /** @var Request $request */
        $this->request = $mvcEvent->getRequest();
        /** @var Response $response */
        $this->response = $mvcEvent->getResponse();

        die(var_dump(
            __METHOD__,
            $this->toArray()
        ));
    }

    public function startTimer($name)
    {

    }

    public function endTimer($name)
    {

    }

    public function markMemoryUsage($name) {
        if (!isset($this->memoryMark[$name]['total'])) {
            $this->memoryMark[$name]['total'] = 0;
            $this->memoryMark['real'] = 0;
        }
        $this->memoryMark[$name]['total'] += memory_get_usage();
        $this->memoryMark[$name]['real'] += memory_get_usage(true);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'method' => $this->request->getMethod(),
            'uri' => $this->request->getUriString(),
            'responseCode' => $this->response->getStatusCode(),
            'execution_time' => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
            'timers' => []
        ];
    }
}