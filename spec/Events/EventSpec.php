<?php

namespace spec\TheMarketingLab\Hg\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TheMarketingLab\Hg\Views\ViewInterface;
use Symfony\Component\HttpFoundation\Request;

class EventSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(123456, 'sessionId', 'collection');
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

    function it_has_a_session_id()
    {
        $this->getSessionId()->shouldReturn('sessionId');
    }

    function it_has_a_collection()
    {
        $this->getCollection()->shouldReturn('collection');
    }

    function it_can_have_data()
    {
        $this->beConstructedWith(123456, 'sessionId', 'collection', array('foo' => 'bar'));
        $this->getData()->shouldReturn(array('foo' => 'bar'));
    }

    function it_can_have_a_test_view(ViewInterface $view)
    {
        $this->beConstructedWith(123456, 'sessionId', 'collection', null, $view);
        $this->getView()->shouldReturn($view);
    }

    function it_can_have_a_request(Request $request)
    {
        $this->beConstructedWith(123456, 'sessionId', 'collection', null, null, $request);
        $this->getRequest()->shouldReturn($request);
    }
}
