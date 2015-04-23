<?php

namespace TheMarketingLab\Hg\Events;

interface EventInterface
{
    public function getTimestamp();
    public function getAppId();
    public function getSessionId();
    public function getName();
    /**
     * @return ViewInterface|null
     */
    public function getView();
    /**
     * @return Request|null
     */
    public function getRequest();
}
