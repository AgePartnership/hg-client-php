<?php

namespace TheMarketingLab\Hg;

use Guzzle\Http\Client;
use Guzzle\Http\ClientInterface;

class Configuration implements ConfigurationInterface
{
    private $accessToken;
    private $uri;
    private $client;

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return ClientInterface
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = $this->makeClient();
        }

        return $this->client;
    }

    private function makeClient()
    {
        if (!$this->getUri() || !$this->getAccessToken()) {
            throw new \LogicException('Can\'t automatically create a client without a URI and access token.');
        }

        return new Client($this->getUri(), array(
            'request.options' => array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                    'Content-Type' => 'application/json'
                )
            )
        ));
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    public function isValid()
    {
        return $this->getAccessToken() && $this->getClient();
    }
}
