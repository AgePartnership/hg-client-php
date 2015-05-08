<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Views\ViewInterface;
use Symfony\Component\HttpFoundation\Request;

class Event implements EventInterface
{
    private $timestamp;
    private $appId;
    private $sessionId;
    private $name;
    private $request;

    public function __construct(
        $timestamp,
        $appId,
        $sessionId,
        $name,
        ViewInterface $view = null,
        Request $request = null
    ) {
        $this->timestamp = $timestamp;
        $this->appId = $appId;
        $this->sessionId = $sessionId;
        $this->name = $name;
        $this->view = $view;
        $this->request = $request;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
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

    public function getView()
    {
        return $this->view;
    }

    public function getRequest()
    {
        return $this->request;
    }
}
