<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */

namespace JTL\OpsGenie\Client;

use GuzzleHttp\Exception\BadResponseException;
use http\Exception\RuntimeException;
use JTL\OpsGenie\Client\Alert\CloseAlertRequest;
use JTL\OpsGenie\Client\Alert\CloseAlertResponse;
use JTL\OpsGenie\Client\Alert\CreateAlertRequest;
use JTL\OpsGenie\Client\Alert\CreateAlertResponse;
use JTL\OpsGenie\Client\Alert\GetAlertRequest;
use JTL\OpsGenie\Client\Alert\GetAlertResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers  \JTL\OpsGenie\Client\AlertApiClient
 * @uses \JTL\OpsGenie\Client\OpsGenieResponse
 */
class AlertApiClientTest extends TestCase
{

    public function testCanSendCreateAlertRequest()
    {
        $clientMock = $this->createMock(HttpClient::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->willReturn($this->createMock(CreateAlertResponse::class));
        $requestMock = $this->createMock(CreateAlertRequest::class);


        $client = new AlertApiClient($clientMock);
        $this->assertInstanceOf(CreateAlertResponse::class, $client->createAlert($requestMock));
    }

    public function testCanSendGetAlertRequest()
    {
        $clientMock = $this->createMock(HttpClient::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->willReturn($this->createMock(GetAlertResponse::class));
        $requestMock = $this->createMock(GetAlertRequest::class);


        $client = new AlertApiClient($clientMock);
        $this->assertInstanceOf(GetAlertResponse::class, $client->getAlert($requestMock));
    }

    public function testCanSendCloseAlertRequest()
    {
        $clientMock = $this->createMock(HttpClient::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->willReturn($this->createMock(CloseAlertResponse::class));
        $requestMock = $this->createMock(CloseAlertRequest::class);


        $client = new AlertApiClient($clientMock);
        $this->assertInstanceOf(CloseAlertResponse::class, $client->closeAlert($requestMock));
    }
}
