<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TheMarketingLab\Hg\Tests\ViewInterface;
use Symfony\Component\HttpFoundation\Request;

class EventSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(123456, 'appId', 'sessionId', 'name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Events\Event');
        $this->shouldImplement('TheMarketingLab\Hg\Events\EventInterface');
    }

    function it_has_a_timestamp()
    {
        $this->getTimestamp()->shouldReturn(123456);
    }

    function it_has_an_app_id()
    {
        $this->getAppId()->shouldReturn('appId');
    }

    function it_has_a_session_id()
    {
        $this->getSessionId()->shouldReturn('sessionId');
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('name');
    }

    function it_can_have_a_test_view(ViewInterface $view)
    {
        $this->beConstructedWith(123456, 'appId', 'sessionId', 'name', $view);
        $this->getView()->shouldReturn($view);
    }

    function it_can_have_a_request(Request $request)
    {
        $this->beConstructedWith(123456, 'appId', 'sessionId', 'name', null, $request);
        $this->getRequest()->shouldReturn($request);
    }
}
