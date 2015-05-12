<?php

namespace TheMarketingLab\Hg\Views;

use Guzzle\Http\Message\Response;
use TheMarketingLab\Hg\Tests\Test;

class ViewFactory implements ViewFactoryInterface
{
    public function create(Response $response)
    {
        # Don't use json() because it returns assoc
        $data = json_decode($response->getBody());

        $test = null;
        if (isset($data->test)) {
            $test = new Test($data->test->id, $data->test->variant);
        }

        return new View($data->segment, $test);
    }
}