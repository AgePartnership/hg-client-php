<?php

namespace TheMarketingLab\Hg\Events;

interface EventClientInterface
{
    public function publish(EventInterface $event);
}
