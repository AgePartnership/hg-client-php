<?php

namespace TheMarketingLab\Hg\Sessions;

interface SessionInterface
{
    public function getAppId();
    public function getSessionId();
    public function getTimestamp();
}
