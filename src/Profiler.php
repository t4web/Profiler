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

    /**
     * @var array
     */
    protected $timers = [];

    /**
     * @var array
     */
    protected $timersReport = [];

    /**
     * @var float
     */
    protected $endTime;

    /**
     * @var int
     */
    protected $profilingTimeout;

    public function __construct($profilingTimeout)
    {
        $this->profilingTimeout = $profilingTimeout;
    }

    public function collect(MvcEvent $mvcEvent)
    {
        $this->endTime = microtime(true);

        /** @var Request $request */
        $this->request = $mvcEvent->getRequest();
        /** @var Response $response */
        $this->response = $mvcEvent->getResponse();

        foreach ($this->timers as $name=>$timer) {
            if (empty($timer['end'])) {
                $this->endTimer($name);
            }
        }
    }

    public function startTimer($name)
    {
        $this->timers[$name] = [
            'start' => microtime(true),
            'end' => null,
            'execution_time' => null,
        ];
    }

    public function endTimer($name)
    {
        $endTime = microtime(true);
        $this->timers[$name]['end'] = $endTime;
        $this->timers[$name]['execution_time'] = round(($endTime - $this->timers[$name]['start']) * 1000);
        $this->timersReport[$name] = $this->timers[$name]['execution_time'] . 'ms';
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
            'execution_time' => ($this->endTime - $_SERVER['REQUEST_TIME_FLOAT']),
            'timers' => $this->timersReport
        ];
    }

    public function getExecutionTime()
    {
        return ($this->endTime - $_SERVER['REQUEST_TIME_FLOAT']);
    }

    public function needStore()
    {
        return ($this->getExecutionTime() * 1000) > $this->profilingTimeout;
    }
}