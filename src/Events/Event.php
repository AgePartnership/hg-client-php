<?php

namespace TheMarketingLab\Hg\Events;

use Symfony\Component\HttpFoundation\Request;
use TheMarketingLab\Hg\Sessions\TestInterface;

class Event implements EventInterface
{
    private $sessionId;
    private $name;
    private $request;
    private $timestamp;
    private $test;
    private $segment;

    public function __construct($sessionId, $name, Request $request, $timestamp, TestInterface $test, $segment)
    {
        $this->sessionId = $sessionId;
        $this->name = $name;
        $this->request = $request;
        $this->timestamp = $timestamp;
        $this->test = $test;
        $this->segment = $segment;
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

    public function getTest()
    {
        return $this->test;
    }

    public function getSegment()
    {
        return $this->segment;
    }

    
}
