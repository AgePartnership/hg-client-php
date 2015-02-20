<?php

namespace TheMarketingLab\Hg\Sessions;

class Session implements SessionInterface
{
    private $appId;
    private $sessionId;
    private $timestamp;

    public function __construct($appId, $sessionId, $timestamp)
    {
        $this->appId = $appId;
        $this->sessionId = $sessionId;
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
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
