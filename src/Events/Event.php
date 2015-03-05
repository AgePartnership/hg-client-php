<?php

namespace TheMarketingLab\Hg\Events;

use Symfony\Component\HttpFoundation\Request;

class Event implements EventInterface
{
    private $appId;
    private $sessionId;
    private $name;
    private $request;
    private $timestamp;
    private $current_test;
    private $test_side;
    private $segment;

    public function __construct($appId, $sessionId, $name, Request $request, $timestamp, $current_test, $test_side, $segment)
    {
        $this->appId = $appId;
        $this->sessionId = $sessionId;
        $this->name = $name;
        $this->request = $request;
        $this->timestamp = $timestamp;
        $this->current_test = $current_test;
        $this->test_side = $test_side;
        $this->segment = $segment;
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

    public function getCurrentTest()
    {
        return $this->current_test;
    }

    public function getTestSide()
    {
        return $this->test_side;
    }

    public function getSegment()
    {
        return $this->segment;
    }
}
