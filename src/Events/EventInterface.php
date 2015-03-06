<?php

namespace TheMarketingLab\Hg\Events;

interface EventInterface
{
    public function getSessionId();
    public function getName();
    /**
     * @return Request
     */
    public function getRequest();
    public function getTimestamp();
    public function getTest();
    public function getSegment();
}
