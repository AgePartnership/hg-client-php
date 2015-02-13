<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Events\EventClientInterface;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;

class EventClient implements EventClientInterface
{
    private $client;

    public function __construct(GuzzleClientInterface $client)
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
        $postdata = json_encode(
            array(
                'appId' => $event->getAppId(),
                'sessionId' => $event->getSessionId(),
                'name' => $event->getName(),
                'request' => $request->__toString(),
                'timestamp' => $event->getTimestamp()
            )
        );
        $guzzlerequest = $this->getClient()->post('/events', array('Content-Type' => 'application/json'), $postdata);
        $response = $guzzlerequest->send();
        return $response;
    }
}
