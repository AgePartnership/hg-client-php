<?php

namespace spec\TheMarketingLab\Hg\Sessions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TheMarketingLab\Hg\Sessions\TestInterface;

class SessionSpec extends ObjectBehavior
{
    function let(TestInterface $test)
    {
        $this->beConstructedWith(1234, $test);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Sessions\Session');
    }

    function it_should_have_an_id()
    {
        $this->getId()->shouldReturn(1234);
    }
    
    function it_should_have_a_test()
    {
        $this->getTest()->shouldImplement('TheMarketingLab\Hg\Sessions\TestInterface');
    }

    function it_should_not_have_a_test()
    {
        $this->beConstructedWith(1234);
        $this->getTest()->shouldReturn(null);
    }

    function it_should_add_a_test(TestInterface $test)
    {
        $this->beConstructedWith(1234);
        $this->addTest($test);
        $this->getTest()->shouldReturn($test);
    }
}
