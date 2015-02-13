<?php

namespace TheMarketingLab\Hg\Events;

interface EventInterface
{
    public function getAppId();
    public function getSessionId();
    public function getName();
    /**
     * @return Request
     */
    public function getRequest();
    public function getTimestamp();
}
