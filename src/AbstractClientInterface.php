<?php

namespace TheMarketingLab\Hg;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;

interface AbstractClientInterface
{
    public function __construct(GuzzleClientInterface $client);
    public function getClient();
}
