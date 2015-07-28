<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Guzzle\Http\Message\RequestInterface as GuzzleRequestInterface;
use TheMarketingLab\Hg\ConfigurationInterface;
use TheMarketingLab\Hg\Events\EventInterface;
use TheMarketingLab\Hg\Views\ViewInterface;
use TheMarketingLab\Hg\Tests\TestInterface;
use Symfony\Component\HttpFoundation\Request;

class EventClientSpec extends ObjectBehavior
{
    function let(ConfigurationInterface $config, GuzzleClientInterface $guzzle)
    {
        $config->getAccessToken()->willReturn('1234');
        $config->getClient()->willReturn($guzzle);
        $config->isValid()->willReturn(true);
        $this->beConstructedWith($config);
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
        $event->getSessionId()->willReturn('sessionId');
        $event->getCollection()->willReturn('name');
        $event->getData()->willReturn(null);
        $event->getView()->willReturn(null);
        $event->getRequest()->willReturn(null);

        $guzzle->post('/events', array(), json_encode(array(
            'timestamp' => 123456,
            'sessionId' => 'sessionId',
            'collection' => 'name'
        )))->willReturn($guzzleRequest);

        $guzzleRequest->send()->willReturn($guzzleResponse);

        $this->publish($event)->shouldReturn($guzzleResponse);
    }

    function it_publishes_an_event_with_data(
        GuzzleClientInterface $guzzle,
        EventInterface $event,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $event->getTimestamp()->willReturn(123456);
        $event->getSessionId()->willReturn('sessionId');
        $event->getCollection()->willReturn('name');
        $event->getData()->willReturn(array('foo' => 'bar'));
        $event->getView()->willReturn(null);
        $event->getRequest()->willReturn(null);

        $guzzle->post('/events', array(), json_encode(array(
            'timestamp' => 123456,
            'sessionId' => 'sessionId',
            'collection' => 'name',
            'data' => array(
                'foo' => 'bar'
            )
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
        $event->getSessionId()->willReturn('sessionId');
        $event->getCollection()->willReturn('name');
        $event->getData()->willReturn(null);
        $event->getView()->willReturn($view);
        $event->getRequest()->willReturn(null);

        $view->getSegment()->willReturn('default');
        $view->getTest()->willReturn($test);
        $test->getId()->willReturn('testId');
        $test->getVariant()->willReturn(0);

        $guzzle->post('/events', array(), json_encode(array(
            'timestamp' => 123456,
            'sessionId' => 'sessionId',
            'collection' => 'name',
            'view' => array(
                'segment' => 'default',
                'test' => array(
                    'id' => 'testId',
                    'variant' => 0
                )
            )
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
        $event->getSessionId()->willReturn('sessionId');
        $event->getCollection()->willReturn('name');
        $event->getData()->willReturn(null);
        $event->getView()->willReturn(null);
        $event->getRequest()->willReturn($request);

        $request->__toString()->willReturn('wow');

        $guzzle->post('/events', array(), json_encode(array(
            'timestamp' => 123456,
            'sessionId' => 'sessionId',
            'collection' => 'name',
            'request' => 'wow'
        )))->willReturn($guzzleRequest);

        $guzzleRequest->send()->willReturn($guzzleResponse);

        $this->publish($event)->shouldReturn($guzzleResponse);
    }
}
