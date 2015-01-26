<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Plugin\Mock\MockPlugin;
use Guzzle\Http\Message\Response as GuzzleResponse;
use TheMarketingLab\Hg\Events\Event;
use Symfony\Component\HttpFoundation\Request;

class EventClientSpec extends ObjectBehavior
{
    function let(GuzzleClientInterface $guzzle)
    {
        $plugin = new MockPlugin();
        $plugin->addResponse(new GuzzleResponse(200));
        $guzzle->addSubscriber($plugin);
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

    function it_should_publish_event()
    {
        $request = new Request();
        $event = new Event('appId', 'sessionId', 'name', $request);
        $response = $this->publish($event);
        $response->shouldHaveType('Guzzle\Http\Message\Response');
        $response->getStatusCode()->shouldBe(400);
    }
}
