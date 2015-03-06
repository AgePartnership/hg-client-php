<?php

namespace TheMarketingLab\Hg;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;

abstract class AbstractClient implements AbstractClientInterface
{
    private $client;
    private $appId;

    public function __construct(GuzzleClientInterface $client, $appId)
    {
        $this->client = $client;
        $this->appId = $appId;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getAppId()
    {
        return $this->appId;
    }
}
