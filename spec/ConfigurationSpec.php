<?php

namespace spec\TheMarketingLab\Hg;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Configuration');
    }

    function it_creates_a_client()
    {
        $this->setUri('http://api.hg3.co');
        $this->setAccessToken('1234');

        $client = $this->getClient();

        $client->shouldHaveType('Guzzle\Http\Client');
        $client->getBaseUrl()->shouldReturn('http://api.hg3.co');
        $client->getDefaultOption('headers')->shouldReturn(array(
            'Authorization' => 'Bearer 1234',
            'Content-Type' => 'application/json'
        ));
    }
}
