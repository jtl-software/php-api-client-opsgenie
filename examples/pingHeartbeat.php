<?php

use JTL\OpsGenie\Client\Alert\Alert;
use JTL\OpsGenie\Client\Alert\CloseAlertRequest;
use JTL\OpsGenie\Client\Alert\CreateAlertRequest;
use JTL\OpsGenie\Client\Alert\GetAlertRequest;
use JTL\OpsGenie\Client\AlertApiClient;
use JTL\OpsGenie\Client\HeartbeatApiClient;
use JTL\OpsGenie\Client\HttpClient;
use JTL\OpsGenie\Client\Priority;

require_once __DIR__ . '/../vendor/autoload.php';

$token = "xxx-xxx-xxx";
$client = new HeartbeatApiClient(HttpClient::createForEUApi($token));
do {
    $result = $client->sendPing(new JTL\OpsGenie\Client\Heartbeat\PingRequest('ea-ebay-workerDaemon'));
    var_dump($result, $result->isSuccessful());
    sleep(60);
} while(true);
