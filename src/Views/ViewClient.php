<?php

namespace TheMarketingLab\Hg\Views;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Client as GuzzleClient;
use Guzzle\Http\Message\Response;
use TheMarketingLab\Hg\ConfigurationInterface;

class ViewClient implements ViewClientInterface
{
    private $client;
    private $viewFactory;

    public function __construct(ConfigurationInterface $config, ViewFactoryInterface $viewFactory = null)
    {
        if (!$config->isValid()) {
            throw new \InvalidArgumentException('Invalid configuration passed to ViewClient');
        }

        $this->client = $config->getClient();
        $this->viewFactory = $viewFactory ?: new ViewFactory();
    }

    public static function create($appId, $uri)
    {
        $client = new GuzzleClient($uri);
        return new self($appId, $client);
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

        $request = $this->getClient()->post('/views', array(), json_encode($data));
        $response = $request->send();

        return $this->getViewFactory()->create($response);
    }
}