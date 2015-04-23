<?php

require __DIR__.'/../vendor/autoload.php';

use TheMarketingLab\Hg\Events\EventClient;
use Guzzle\Plugin\Log\LogPlugin;
use Guzzle\Log\MessageFormatter;
use Guzzle\Log\ClosureLogAdapter;
use TheMarketingLab\Hg\Events\Event;
use TheMarketingLab\Hg\Tests\View;
use TheMarketingLab\Hg\Tests\Test;
use Symfony\Component\HttpFoundation\Request;

if (!$baseUrl = getenv('HG_API_URI')) {
    echo "You must set HG_API_URI\n";
    exit(1);
}

$uri = "$baseUrl/events";

$client = EventClient::create($uri);

$logAdapter = new ClosureLogAdapter(function ($message) {
    echo "$message\n";
});
$logPlugin = new LogPlugin($logAdapter, MessageFormatter::DEBUG_FORMAT);
$client->getClient()->addSubscriber($logPlugin);

$view = new View('default', new Test('testId', '0'));
$request = Request::create('/');

$event = new Event(123456, 'appId', 'sessionId', 'name');
$client->publish($event);

$event = new Event(123456, 'appId', 'sessionId', 'name', $view);
$client->publish($event);

$event = new Event(123456, 'appId', 'sessionId', 'name', $view, $request);
$client->publish($event);
