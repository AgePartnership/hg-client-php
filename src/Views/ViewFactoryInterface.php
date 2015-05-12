<?php

namespace TheMarketingLab\Hg\Views;

use Guzzle\Http\Message\Response;

interface ViewFactoryInterface
{
    public function create(Response $response);
}