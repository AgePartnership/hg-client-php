<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Views\ViewInterface;
use Symfony\Component\HttpFoundation\Request;

class Event implements EventInterface
{
    private $timestamp;
    private $sessionId;
    private $collection;
    private $request;

    public function __construct(
        $timestamp,
        $sessionId,
        $collection,
        $data = null,
        ViewInterface $view = null,
        Request $request = null
    ) {
        $this->timestamp = $timestamp;
        $this->sessionId = $sessionId;
        $this->collection = $collection;
        $this->data = $data;
        $this->view = $view;
        $this->request = $request;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @return null
     */
    public function getData()
    {
        return $this->data;
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
