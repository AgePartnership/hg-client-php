<?php

namespace spec\TheMarketingLab\Hg\Views;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Guzzle\Http\Message\Response;

class ViewFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Views\ViewFactory');
    }

    function it_creates_a_view_with_no_test(
        Response $response
    ) {
        $response->getBody()->willReturn(json_encode(array(
            'segment' => 'default'
        )));

        $view = $this->create($response);
        $view->getSegment()->shouldReturn('default');
        $view->getTest()->shouldReturn(null);
    }

    function it_creates_a_view_with_a_test(
        Response $response
    ) {
        $response->getBody()->willReturn(json_encode(array(
            'segment' => 'default',
            'test' => array(
                'id' => '123',
                'variant' => 'A'
            )
        )));

        $view = $this->create($response);
        $view->getSegment()->shouldReturn('default');
        $test = $view->getTest();
        $test->shouldHaveType('TheMarketingLab\Hg\Tests\Test');
        $test->getId()->shouldReturn('123');
        $test->getVariant()->shouldReturn('A');
    }
}