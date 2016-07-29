<?php

namespace T4web\Profiler\Domain\PageProfile;

use T4webDomain\Entity;

class PageProfile extends Entity
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var int
     */
    protected $responseCode;

    /**
     * @var int
     */
    protected $executionTime;

    /**
     * @var array
     */
    protected $timers;

    /**
     * @var string
     */
    protected $createdDt;

    public function populate(array $array = [])
    {
        if ($this->id === null && empty($array['id'])) {
            if (empty($array['createdDt'])) {
                $array['createdDt'] = date('Y-m-d H:i:s');
            }
        }

        parent::populate($array);
    }
}