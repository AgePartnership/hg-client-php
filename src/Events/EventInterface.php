<?php

namespace TheMarketingLab\Hg\Events;

interface EventInterface
{
    public function getTimestamp();
    public function getSessionId();
    public function getCollection();
    public function getData();
    /**
     * @return ViewInterface|null
     */
    public function getView();
    /**
     * @return Request|null
     */
    public function getRequest();
}
