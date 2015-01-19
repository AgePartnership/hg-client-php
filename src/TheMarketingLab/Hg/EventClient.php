<?php

namespace TheMarketingLab\Hg;

use \Guzzle\Http\Client;

class EventClient
{
    private $url = "http://localhost/";
    private $guzzleClient = "";

    private function __construct()
    {
        $this->guzzleClient = new Client($this->url);
    }

    public function addEvent($dataArray)
    {
        $jsonArray = json_encode($dataArray);
        $request = $this->guzzleClient->post('');
        $request->setBody($jsonArray, 'application/json');
        try {
            $response = $request->send();
        } catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {
            # 4xx Errors
            echo 'Uh oh! ' . $e->getMessage();
            echo 'HTTP request URL: ' . $e->getRequest()->getUrl() . "\n";
            echo 'HTTP request: ' . $e->getRequest() . "\n";
            echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
            echo 'HTTP response: ' . $e->getResponse() . "\n";

        } catch (\Guzzle\Http\Exception\ServerErrorResponseException $e) {
            # 5xx Errors
            echo 'Uh oh! ' . $e->getMessage();
            echo 'HTTP request URL: ' . $e->getRequest()->getUrl() . "\n";
            echo 'HTTP request: ' . $e->getRequest() . "\n";
            echo 'HTTP response status: ' . $e->getResponse()->getStatusCode() . "\n";
            echo 'HTTP response: ' . $e->getResponse() . "\n";

        }
        
    }
}
