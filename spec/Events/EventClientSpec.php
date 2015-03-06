<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Guzzle\Http\Message\RequestInterface as GuzzleRequestInterface;
use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Sessions\TestInterface;
use Symfony\Component\HttpFoundation\Request;

class EventClientSpec extends ObjectBehavior
{
    function let(GuzzleClientInterface $guzzle)
    {
        $this->beConstructedWith($guzzle,'appId');
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Events\EventClient');
        $this->shouldImplement('TheMarketingLab\Hg\Events\EventClientInterface');
    }

    function it_should_have_an_app_id()
    {
        $this->getAppId()->shouldReturn('appId');
    }

    function it_should_have_client()
    {
        $this->getClient()->shouldImplement('Guzzle\Http\ClientInterface');
    }

    function it_should_publish_event(
        GuzzleClientInterface $guzzle,
        EventInterface $event,
        Request $request,
        TestInterface $test,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $event->getSessionId()->willReturn('sessionId');
        $event->getName()->willReturn('name');
        $event->getRequest()->willReturn($request);
        $event->getTimestamp()->willReturn(123456);
        $event->getTest()->willReturn($test);
        $test->getId()->willReturn(1);
        $test->getVariant()->willReturn(0);
        $event->getSegment()->willReturn('default');

        $request->__toString()->willReturn('wow');

        $guzzle->post('/events', array('Content-Type' => 'application/json'), json_encode(
            array(
            'appId' => 'appId',
            'sessionId' => 'sessionId',
            'name' => 'name',
            'request' => 'wow',
            'timestamp' => 123456,
            'test' => array(
                'id' => 1,
                'variant' => 0
            ),
            'segment' => 'default'
            )
        ))->willReturn($guzzleRequest);

        $guzzleRequest->send()->willReturn($guzzleResponse);

        $this->publish($event)->shouldReturn($guzzleResponse);
    }
}
