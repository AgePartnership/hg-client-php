<?php

namespace TheMarketingLab\Hg\Views;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Client as GuzzleClient;
use Guzzle\Http\Message\Response;

class ViewClient implements ViewClientInterface
{
    private $client;
    private $viewFactory;

    public function __construct(GuzzleClientInterface $client, ViewFactoryInterface $viewFactory = null)
    {
        $this->client = $client;
        $this->viewFactory = $viewFactory ?: new ViewFactory();
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

    public function getViewFactory()
    {
        return $this->viewFactory;
    }

    public function update(ViewInterface $view)
    {
        $data = array(
            'segment' => $view->getSegment()
        );

        if ($test = $view->getTest()) {
            $data['test'] = array(
                'id' => $test->getId(),
                'variant' => $test->getVariant()
            );
        }

        $headers = array(
            'Content-Type' => 'application/json'
        );

        $request = $this->getClient()->post('/views', $headers, json_encode($data));
        $response = $request->send();

        return $this->getViewFactory()->create($response);
    }
}