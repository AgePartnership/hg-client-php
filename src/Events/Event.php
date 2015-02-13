<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;
use Symfony\Component\HttpFoundation\Request;

class Event implements EventInterface
{
    private $appId;
    private $sessionId;
    private $name;
    private $request;
    private $timestamp;

    public function __construct($appId, $sessionId, $name, Request $request, $timestamp)
    {
        $this->appId = $appId;
        $this->sessionId = $sessionId;
        $this->name = $name;
        $this->request = $request;
        $this->timestamp = $timestamp;
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
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
