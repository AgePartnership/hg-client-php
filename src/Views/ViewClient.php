<?php

namespace TheMarketingLab\Hg\Views;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;

class ViewClient implements ViewClientInterface
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
