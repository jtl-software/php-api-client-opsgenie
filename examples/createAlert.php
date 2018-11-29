<?php

use JTL\OpsGenie\Client\Alert\Alert;
use JTL\OpsGenie\Client\Alert\CloseAlertRequest;
use JTL\OpsGenie\Client\Alert\CreateAlertRequest;
use JTL\OpsGenie\Client\Alert\GetAlertRequest;
use JTL\OpsGenie\Client\AlertApiClient;
use JTL\OpsGenie\Client\Priority;

require_once __DIR__ . '/../vendor/autoload.php';

$token = "xxx-xxx-xxx";
$client = AlertApiClient::createForEUApi($token);
$alert = new Alert(
    'eazyauction',
    'test-alert',
    'foo mag bär',
    'beer-bar',
    Priority::informational()
);
$alert->setDescription(<<< MSG
<strong>Foo</strong>

<a href="https://example.com">Click</a> there

<!-- no colors ... so sad :( -->
<p style="color: red">Beer</p>

<pre>
    while(thirsty()) {
        drink(\$beer);
    }
</pre>

Simple Text is also fine 
you can do some line brakes.
Like
this.
MSG
);
$alert->appendTag('foo')->appendTag('bar');

$request = new CreateAlertRequest($alert);
$_ = $client->createAlert($request);

var_dump(
    $_->isSuccessful(),
    $_->getStatusCode(),
    $_->getMessage(),
    $_->getRequestId()
);

if (!$_->isSuccessful()) {
    exit;
}

$request = new GetAlertRequest('test-alert');
do {
    usleep(1000000);
    $alertResponse = $client->getAlert($request);
    $alert = $alertResponse->getAlert();
} while ($alert === null);

echo "Waiting for escalation\n\n";
sleep(3);

var_dump(
    $alert->getAlias(),
    $alert->getEntity(),
    $alert->getSource(),
    $alert->getPriority(),
    $alert->getMessage(),
    $alert->getTags(),
    $alert->getResponders(),
    $alert->getDescription()
);

$request = new CloseAlertRequest($alert->getAlias());
$_ = $client->closeAlert($request);
var_dump($_->isSuccessful());


