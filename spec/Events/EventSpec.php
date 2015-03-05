<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Request;
use TheMarketingLab\Hg\Sessions\TestInterface;

class EventSpec extends ObjectBehavior
{
    public function let(Request $request, TestInterface $test)
    {
        $this->beConstructedWith('appId', 'sessionId', 'name', $request, 123456, $test, 'default');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Events\Event');
        $this->shouldImplement('TheMarketingLab\Hg\Events\EventInterface');
    }

    function it_should_have_an_app_id()
    {
        $this->getAppId()->shouldReturn('appId');
    }

    function it_should_have_a_session_id()
    {
        $this->getSessionId()->shouldReturn('sessionId');
    }

    function it_should_have_a_name()
    {
        $this->getName()->shouldReturn('name');
    }

    function it_should_have_a_request()
    {
        $this->getRequest()->shouldImplement('Symfony\Component\HttpFoundation\Request');
    }

    function it_should_have_a_timestamp()
    {
        $this->getTimestamp()->shouldReturn(123456);
    }

    function it_should_have_a_test()
    {
        $this->getTest()->shouldImplement('TheMarketingLab\Hg\Sessions\TestInterface');
    }

    function it_should_have_a_segment()
    {
        $this->getSegment()->shouldReturn('default');
    }

}
