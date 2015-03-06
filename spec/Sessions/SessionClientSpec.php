<?php

namespace spec\TheMarketingLab\Hg\Sessions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Guzzle\Http\ClientInterface as GuzzleClientInterface;
use Guzzle\Http\Message\Response as GuzzleResponse;
use Guzzle\Http\Message\RequestInterface as GuzzleRequestInterface;
use TheMarketingLab\Hg\Sessions\Session;
use TheMarketingLab\Hg\Sessions\SessionInterface;
use TheMarketingLab\Hg\Sessions\TestInterface;
use TheMarketingLab\Hg\Sessions\Test;

class SessionClientSpec extends ObjectBehavior
{
    function let(GuzzleClientInterface $guzzle)
    {
        $this->beConstructedWith($guzzle,'appId');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('TheMarketingLab\Hg\Sessions\SessionClient');
        $this->shouldImplement('TheMarketingLab\Hg\Sessions\SessionClientInterface');
    }

    function it_should_have_client()
    {
        $this->getClient()->shouldImplement('Guzzle\Http\ClientInterface');
    }

    function it_should_have_an_app_id()
    {
        $this->getAppId()->shouldReturn('appId');
    }

    function it_should_get_session_and_api_has_no_running_test(
        GuzzleClientInterface $guzzle,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $guzzle->createRequest('GET', 'sessions/1234', array(), null, array())->willReturn($guzzleRequest);
        $guzzleRequest->send()->willReturn($guzzleResponse);
        # API returns no test
        $guzzleResponse->json()->willReturn(array());

        $session = $this->getSession(1234);
        $session->shouldHaveType('TheMarketingLab\Hg\Sessions\Session');
        $test = $session->getTest();
        $test->shouldBe(null);
    }

    function it_should_get_session_and_api_has_running_test(
        GuzzleClientInterface $guzzle,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse
    ) {
        $guzzle->createRequest('GET', 'sessions/1234', array(), null, array())->willReturn($guzzleRequest);
        $guzzleRequest->send()->willReturn($guzzleResponse);
        # API returns a test
        $guzzleResponse->json()->willReturn(array('test'=>array('id'=>5678,'variant'=>1)));
        
        $session = $this->getSession(1234);
        $session->shouldHaveType('TheMarketingLab\Hg\Sessions\Session');
        $test = $session->getTest();
        $test->shouldHaveType('TheMarketingLab\Hg\Sessions\Test');
        $test->getId()->shouldReturn(5678);
        $test->getVariant()->shouldReturn(1);
    }

    function it_should_get_session_with_test_and_api_has_no_running_test(
        GuzzleClientInterface $guzzle,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse,
        TestInterface $startTest
    ) {
        $startTest->getId()->willReturn(5678);
        $startTest->getVariant()->willReturn(1);
        $guzzle->createRequest('GET', 'sessions/1234', array(), array('id'=>5678,'variant'=>1), array())->willReturn($guzzleRequest);
        $guzzleRequest->send()->willReturn($guzzleResponse);
        # API returns no test
        $guzzleResponse->json()->willReturn(array());

        $session = $this->getSession(1234, $startTest);
        $session->shouldHaveType('TheMarketingLab\Hg\Sessions\Session');
        $test = $session->getTest();
        $test->shouldBe(null);
    }
    function it_should_get_session_with_test_and_api_test_still_running(
        GuzzleClientInterface $guzzle,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse,
        TestInterface $startTest
    ) {
        $startTest->getId()->willReturn(5678);
        $startTest->getVariant()->willReturn(1);
        $guzzle->createRequest('GET', 'sessions/1234', array(), array('id'=>5678,'variant'=>1), array())->willReturn($guzzleRequest);
        $guzzleRequest->send()->willReturn($guzzleResponse);
        # API returns the same test
        $guzzleResponse->json()->willReturn(array('test'=>array('id'=>5678,'variant'=>1)));

        $session = $this->getSession(1234, $startTest);
        $session->shouldHaveType('TheMarketingLab\Hg\Sessions\Session');
        $test = $session->getTest();
        $test->shouldHaveType('TheMarketingLab\Hg\Sessions\Test');
        $test->getId()->shouldReturn(5678);
        $test->getVariant()->shouldReturn(1);
    }
    function it_should_get_session_with_test_and_api_has_new_running_test(
        GuzzleClientInterface $guzzle,
        GuzzleRequestInterface $guzzleRequest,
        GuzzleResponse $guzzleResponse,
        TestInterface $startTest
    ) {
        $startTest->getId()->willReturn(5678);
        $startTest->getVariant()->willReturn(1);
        $guzzle->createRequest('GET', 'sessions/1234', array(), array('id'=>5678,'variant'=>1), array())->willReturn($guzzleRequest);
        $guzzleRequest->send()->willReturn($guzzleResponse);

        # API returns a different test
        $guzzleResponse->json()->willReturn(array('test'=>array('id'=>9876,'variant'=>0)));

        $session = $this->getSession(1234, $startTest);
        $session->shouldHaveType('TheMarketingLab\Hg\Sessions\Session');
        $test = $session->getTest();
        $test->shouldHaveType('TheMarketingLab\Hg\Sessions\Test');
        $test->getId()->shouldReturn(9876);
        $test->getVariant()->shouldReturn(0);
    }

}
