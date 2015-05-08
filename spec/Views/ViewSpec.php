<?php

namespace spec\TheMarketingLab\Hg\Views;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use TheMarketingLab\Hg\Tests\TestInterface;

class ViewSpec extends ObjectBehavior
{

    function let(TestInterface $test)
    {
        $this->beConstructedWith('default', $test);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Views\View');
    }

    function it_should_have_test($test){
        $this->getTest()->shouldImplement('TheMarketingLab\Hg\Tests\TestInterface');
        $this->getTest()->shouldBe($test);
    }

    function it_should_have_segment()
    {
        $this->getSegment()->shouldReturn('default');
    }

    function it_should_not_have_test()
    {
        $this->beConstructedWith('default');
        $this->getTest()->shouldReturn(null);
    }
}
