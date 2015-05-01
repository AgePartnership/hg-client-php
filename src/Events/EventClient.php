<?php

namespace TheMarketingLab\Hg\Events;

use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Events\EventClientInterface;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Client as GuzzleClient;

class EventClient implements EventClientInterface
{
    private $client;

    public function __construct(GuzzleClientInterface $client)
    {
        $this->client = $client;
    }

    public static function create($uri)
    {
        $client = new GuzzleClient($uri);
        return new self($client);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function publish(EventInterface $event)
    {
        $data = array(
            'timestamp' => $event->getTimestamp(),
            'appId' => $event->getAppId(),
            'sessionId' => $event->getSessionId(),
            'name' => $event->getName(),
            'view' => null,
            'request' => null
        );

        if ($view = $event->getView()) {
            $data['view'] = array(
                'segment' => $view->getSegment(),
                'test' => null
            );

            if ($test = $view->getTest()) {
                $data['view']['test'] = array(
                    'id' => $test->getId(),
                    'variant' => $test->getVariant()
                );
            }
        }

        if ($request = $event->getRequest()) {
            $data['request'] = $request->__toString();
        }

        $headers = array(
            'Content-Type' => 'application/json'
        );

        $httpRequest = $this->getClient()->post('/events', $headers, json_encode($data));
        $response = $httpRequest->send();

        return $response;
    }
}
