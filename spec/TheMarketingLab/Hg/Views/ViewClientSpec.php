<?php

namespace spec\TheMarketingLab\Hg\Views;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Guzzle\Http\Message\RequestInterface as GuzzleRequestInterface;
use TheMarketingLab\Hg\Views\ViewInterface;
use TheMarketingLab\Hg\Tests\TestInterface;

class ViewClientSpec extends ObjectBehavior
{
    function let(GuzzleClientInterface $guzzle)
    {
        $this->beConstructedWith($guzzle);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Views\ViewClient');
    }

    function it_is_a_view_client()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Views\ViewClientInterface');
    }

    function it_updates_a_view(
        GuzzleClientInterface $guzzle,
        ViewInterface $view,
        GuzzleRequestInterface $request,
        GuzzleResponse $response
    ) {
        $view->getSegment()->willReturn('default');
        $view->getTest()->willReturn(null);

        $guzzle->post('/view', array('Content-Type' => 'application/json'), json_encode(array(
            'segment' => 'default'
        )))->shouldBeCalled()->willReturn($request);

        $request->send()->shouldBeCalled()->willReturn($response);

        $this->update($view)->shouldReturn($response);
    }

    function it_updates_a_view_with_a_test(
        GuzzleClientInterface $guzzle,
        ViewInterface $view,
        TestInterface $test,
        GuzzleRequestInterface $request,
        GuzzleResponse $response
    ) {
        $view->getSegment()->willReturn('default');
        $view->getTest()->willReturn($test);
        $test->getId()->willReturn('123');
        $test->getVariant()->willReturn('A');

        $guzzle->post('/view', array('Content-Type' => 'application/json'), json_encode([
            'segment' => 'default',
            'test' => [
                'id' => '123',
                'variant' => 'A'
            ]
        ]))->shouldBeCalled()->willReturn($request);

        $request->send()->shouldBeCalled()->willReturn($response);

        $this->update($view)->shouldReturn($response);
    }
}
