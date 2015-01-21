<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;

interface EventClientInterface
{
    public function publish(EventInterface $event);
}
