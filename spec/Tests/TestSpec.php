<?php

namespace spec\TheMarketingLab\Hg\Tests;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TestSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1234, 1);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Tests\Test');
    }

    function it_should_have_id()
    {
        $this->getId()->shouldReturn(1234);
    }

    function it_should_have_variant()
    {
        $this->getVariant()->shouldReturn(1);
    }
}
