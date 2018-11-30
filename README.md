# JTL - PHP API Client for OpsGenie

[![Build Status](https://travis-ci.org/JTLSoftwareGmbH/php-api-client-opsgenie.svg?branch=master)](https://travis-ci.org/JTLSoftwareGmbH/php-api-client-opsgenie)

PHP implementation to connect to OpsGenie Alert API. The implementation is focused on what
we require @JTL for our application Alerting.

https://docs.opsgenie.com/docs/alert-api

## Features

* Create Alert
* Get specific Alert (by alias) from API
* Close Alert 

## How-To-Use

````php
# named constructor to create a client (for EU)
$client = AlertApiClient::createForEUApi(getenv(UPSGENIE_TOKEN));

$alert = new Alert('eazyauction', 'test-alert', 'foo mag bär', 'beer-bar');
$response = $client->createAlert($alert);

if($response->isSuccessful()){
  
    // read our former created alert
    $alert = $client->getAlert(new GetAlertRequest($alert->getAlias()));

    // close our former created alert
    $client->closeAlert(new CloseAlertRequest($alert->getAlias()));
}
````
