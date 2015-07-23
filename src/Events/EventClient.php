<?php

namespace TheMarketingLab\Hg\Events;

use Guzzle\Http\Client as GuzzleClient;
use TheMarketingLab\Hg\ConfigurationInterface;

class EventClient implements EventClientInterface
{
    private $client;

    public function __construct(ConfigurationInterface $config)
    {
        if (!$config->isValid()) {
            throw new \InvalidArgumentException('Invalid configuration passed to EventClient');
        }

        $this->client = $config->getClient();
    }

    public function getClient()
    {
        return $this->client;
    }

    public function publish(EventInterface $event)
    {
        $data = array(
            'timestamp' => $event->getTimestamp(),
            'sessionId' => $event->getSessionId(),
            'collection' => $event->getCollection()
        );

        if ($eventData = $event->getData()) {
            $data['data'] = $eventData;
        }

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

        $httpRequest = $this->getClient()->post('/events', array(), json_encode($data));
        $response = $httpRequest->send();

        return $response;
    }
}
