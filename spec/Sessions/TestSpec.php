<?php

namespace spec\TheMarketingLab\Hg\Sessions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1, 0);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Sessions\Test');
        $this->shouldImplement('TheMarketingLab\Hg\Sessions\TestInterface');
    }

    function it_should_have_an_id()
    {
        $this->getId()->shouldReturn(1);
    }

    function it_should_have_a_variant()
    {
        $this->getVariant()->shouldReturn(0);
    }
}
