<?php

namespace spec\TheMarketingLab\Hg\Views;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Guzzle\Http\ClientInterface as GuzzleClientInterface;

class ViewClientSpec extends ObjectBehavior
{
    function let(GuzzleClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Views\ViewClient');
        $this->shouldImplement('TheMarketingLab\Hg\Views\ViewClientInterface');
    }

    function it_has_a_client(GuzzleClientInterface $client)
    {
        $this->getClient()->shouldImplement('Guzzle\Http\ClientInterface');
        $this->getClient()->shouldBe($client);
    }
}
