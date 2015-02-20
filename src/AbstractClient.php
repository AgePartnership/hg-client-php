<?php

namespace TheMarketingLab\Hg;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;

abstract class AbstractClient implements AbstractClientInterface
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
}
