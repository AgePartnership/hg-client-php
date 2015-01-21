<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;
use Symfony\Component\HttpFoundation\Request;

class Event implements EventInterface
{
    private $appId;

    public function __construct($appId, $sessionId, $name, Request $request)
    {
        $this->appId = $appId;
        $this->sessionId = $sessionId;
        $this->name = $name;
        $this->request = $request;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
