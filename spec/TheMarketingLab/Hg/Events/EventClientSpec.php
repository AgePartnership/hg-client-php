<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Guzzle\Http\Message\RequestInterface as GuzzleRequestInterface;
use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Views\ViewInterface;
use TheMarketingLab\Hg\Tests\TestInterface;
use Symfony\Component\HttpFoundation\Request;

class EventClientSpec extends ObjectBehavior
{
    function let(GuzzleClientInterface $guzzle)
    {
        $this->beConstructedWith($guzzle);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Events\EventClient');
        $this->shouldImplement('TheMarketingLab\Hg\Events\EventClientInterface');
    }

    function it_has_a_client()
    {
        $this->getClient()->shouldImplement('Guzzle\Http\ClientInterface');
    }

    function it_publishes_an_event(
        GuzzleClientInterface $guzzle,
        EventInterface $event,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $event->getTimestamp()->willReturn(123456);
        $event->getAppId()->willReturn('appId');
        $event->getSessionId()->willReturn('sessionId');
        $event->getName()->willReturn('name');
        $event->getView()->willReturn(null);
        $event->getRequest()->willReturn(null);

        $guzzle->post('/events', array('Content-Type' => 'application/json'), json_encode(array(
            'timestamp' => 123456,
            'appId' => 'appId',
            'sessionId' => 'sessionId',
            'name' => 'name',
            'view' => null,
            'request' => null
        )))->willReturn($guzzleRequest);

        $guzzleRequest->send()->willReturn($guzzleResponse);

        $this->publish($event)->shouldReturn($guzzleResponse);
    }

    function it_publishes_an_event_with_a_view(
        GuzzleClientInterface $guzzle,
        EventInterface $event,
        ViewInterface $view,
        TestInterface $test,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $event->getTimestamp()->willReturn(123456);
        $event->getAppId()->willReturn('appId');
        $event->getSessionId()->willReturn('sessionId');
        $event->getName()->willReturn('name');
        $event->getView()->willReturn($view);
        $event->getRequest()->willReturn(null);

        $view->getSegment()->willReturn('default');
        $view->getTest()->willReturn($test);
        $test->getId()->willReturn('testId');
        $test->getVariant()->willReturn(0);

        $guzzle->post('/events', array('Content-Type' => 'application/json'), json_encode(array(
            'timestamp' => 123456,
            'appId' => 'appId',
            'sessionId' => 'sessionId',
            'name' => 'name',
            'view' => array(
                'segment' => 'default',
                'test' => array(
                    'id' => 'testId',
                    'variant' => 0
                )
            ),
            'request' => null
        )))->willReturn($guzzleRequest);

        $guzzleRequest->send()->willReturn($guzzleResponse);

        $this->publish($event)->shouldReturn($guzzleResponse);
    }

    function it_publishes_an_event_with_a_request(
        GuzzleClientInterface $guzzle,
        EventInterface $event,
        Request $request,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $event->getTimestamp()->willReturn(123456);
        $event->getAppId()->willReturn('appId');
        $event->getSessionId()->willReturn('sessionId');
        $event->getName()->willReturn('name');
        $event->getView()->willReturn(null);
        $event->getRequest()->willReturn($request);

        $request->__toString()->willReturn('wow');

        $guzzle->post('/events', array('Content-Type' => 'application/json'), json_encode(array(
            'timestamp' => 123456,
            'appId' => 'appId',
            'sessionId' => 'sessionId',
            'name' => 'name',
            'view' => null,
            'request' => 'wow'
        )))->willReturn($guzzleRequest);

        $guzzleRequest->send()->willReturn($guzzleResponse);

        $this->publish($event)->shouldReturn($guzzleResponse);
    }
}
