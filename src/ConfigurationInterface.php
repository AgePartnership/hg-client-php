<?php

namespace TheMarketingLab\Hg;

use Guzzle\Http\ClientInterface;

interface ConfigurationInterface
{
    /**
     * @return string
     */
    public function getAccessToken();

    /**
     * @return string
     */
    public function getUri();

    /**
     * @return ClientInterface
     */
    public function getClient();

    /**
     * @return boolean
     */
    public function isValid();
}