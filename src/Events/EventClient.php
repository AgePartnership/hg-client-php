<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Events\EventClientInterface;
use Guzzle\Http\Client as GuzzleClient;

class EventClient implements EventClientInterface
{
    private $client;

    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function publish(EventInterface $event)
    {
        $request = $event->getRequest();
        $this->getClient()->post('/', json_encode([
            'appId' => $event->getAppId(),
            'sessionId' => $event->getSessionId(),
            'name' => $event->getName(),
            'request' => $request->__toString()
        ]));
    }
}
