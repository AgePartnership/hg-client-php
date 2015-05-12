<?php

namespace TheMarketingLab\Hg\Views;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Client as GuzzleClient;

class ViewClient implements ViewClientInterface
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

        $request = $this->getClient()->post('/view', $headers, json_encode($data));
        $response = $request->send();

        return $response;
    }
}