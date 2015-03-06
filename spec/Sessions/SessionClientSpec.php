<?php

namespace spec\TheMarketingLab\Hg\Sessions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Guzzle\Http\Message\RequestInterface as GuzzleRequestInterface;
use TheMarketingLab\Hg\Sessions\Session;
use TheMarketingLab\Hg\Sessions\SessionInterface;
use TheMarketingLab\Hg\Sessions\TestInterface;
use TheMarketingLab\Hg\Sessions\Test;

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

    function it_should_get_session_with_id(
        GuzzleClientInterface $guzzle,
        SessionInterface $session,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $session->getId()->willReturn(1234);
        $session->getAppId()->willReturn('stonetrader');
        $session->getTest()->willReturn(null);
        

        $guzzle->createRequest('GET', "sessions/1234", array(), null, array())->willReturn($guzzleRequest);

        $guzzleRequest->send()->willReturn($guzzleResponse);

        $guzzleResponse->json()->willReturn(array('id'=>5678, 'variant' => 1));

        $test = new Test(5678, 1);
        $session->addTest($test)->shouldBeCalled();

        $this->getSession($session)->shouldImplement('TheMarketingLab\Hg\Sessions\SessionInterface');
    }

}
