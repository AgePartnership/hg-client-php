<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Guzzle\Http\Message\RequestInterface as GuzzleRequestInterface;
use TheMarketingLab\Hg\Events\EventInterface;
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

    function it_should_have_client()
    {
        $this->getClient()->shouldImplement('Guzzle\Http\ClientInterface');
    }

    function it_should_publish_event(
        GuzzleClientInterface $client,
        EventInterface $event,
        Request $request,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    )   {
            $event->getAppId()->willReturn('appId');
            $event->getSessionId()->willReturn('sessionId');
            $event->getName()->willReturn('name');
            $event->getRequest()->willReturn($request);

            $request->__toString()->willReturn('wow');

            $this->getClient()->willReturn($client);

            $client->post('/', json_encode([
                'appId' => 'appId',
                'sessionId' => 'sessionId',
                'name' => 'name',
                'request' => 'wow'
            ]))->willReturn($guzzleRequest);

            $guzzleRequest->send()->willReturn($guzzleResponse);

            $this->publish($event)->shouldReturn($response);
        }
}
