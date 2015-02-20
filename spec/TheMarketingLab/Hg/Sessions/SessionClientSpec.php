<?php

namespace spec\TheMarketingLab\Hg\Sessions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;

class SessionClientSpec extends ObjectBehavior
{
    function let(GuzzleClientInterface $guzzle)
    {
        $this->beConstructedWith($guzzle);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Sessions\SessionClient');
        $this->shouldImplement('TheMarketingLab\Hg\Sessions\SessionClientInterface');
    }

    function it_should_have_client()
    {
        $this->getClient()->shouldImplement('Guzzle\Http\ClientInterface');
    }
}
