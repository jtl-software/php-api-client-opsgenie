<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 11/23/18
 */

namespace JTL\OpsGenie\Client;

use GuzzleHttp\Exception\BadResponseException;
use JTL\OpsGenie\Client\Alert\CloseAlertRequest;
use JTL\OpsGenie\Client\Alert\CloseAlertResponse;
use JTL\OpsGenie\Client\Alert\CreateAlertRequest;
use JTL\OpsGenie\Client\Alert\CreateAlertResponse;
use JTL\OpsGenie\Client\Alert\GetAlertRequest;
use JTL\OpsGenie\Client\Alert\GetAlertResponse;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers  \JTL\OpsGenie\Client\AlertApiClient
 * @uses \JTL\OpsGenie\Client\OpsGenieResponse
 */
class AlertApiClientTest extends TestCase
{
    public function testCanSendAnyRequest()
    {
        $curlMock = $this->createMock(\GuzzleHttp\Client::class);
        $curlMock->expects($this->once())->method('request')
            ->with(
                'POST',
                '/any',
                [
                    'headers' => [
                        'Authorization' => 'GenieKey 123',
                        'Content-Type' => 'application/json'
                    ],
                    'body' => '{"foo":"bar"}',
                ]
            )
            ->willReturn($this->createMock(ResponseInterface::class));

        $requestMock = $this->createMock(OpsGenieRequest::class);
        $requestMock->expects($this->exactly(2))->method('getHttpMethod')->willReturn('POST');
        $requestMock->expects($this->once())->method('getUrl')->willReturn('/any');
        $requestMock->expects($this->exactly(2))->method('getBody')->willReturn(["foo" => "bar"]);

        $client = new AlertApiClient(123, $curlMock);
        $this->assertInstanceOf(ResponseInterface::class, $client->request($requestMock));
    }

    public function testCanSendCreateAlertRequest()
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('getStatusCode')->willReturn(202);
        $responseMock->method('getBody')->willReturn("{}");

        $curlMock = $this->createMock(\GuzzleHttp\Client::class);
        $curlMock->expects($this->once())->method('request')
            ->willReturn($responseMock);

        $client = new AlertApiClient(123, $curlMock);
        $requestMock = $this->createMock(CreateAlertRequest::class);
        $requestMock->expects($this->once())->method('getBody')->willReturn([]);

        $this->assertInstanceOf(CreateAlertResponse::class, $client->createAlert($requestMock));
    }

    public function testCanSendGetAlertRequest()
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('getStatusCode')->willReturn(200);
        $responseMock->method('getBody')->willReturn("{}");

        $curlMock = $this->createMock(\GuzzleHttp\Client::class);
        $curlMock->expects($this->once())->method('request')
            ->willReturn($responseMock);

        $client = new AlertApiClient(123, $curlMock);
        $requestMock = $this->createMock(GetAlertRequest::class);
        $requestMock->expects($this->once())->method('getBody')->willReturn([]);

        $this->assertInstanceOf(GetAlertResponse::class, $client->getAlert($requestMock));
    }

    public function testCanSendCloseAlertRequest()
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('getStatusCode')->willReturn(202);
        $responseMock->method('getBody')->willReturn("{}");

        $curlMock = $this->createMock(\GuzzleHttp\Client::class);
        $curlMock->expects($this->once())->method('request')
            ->willReturn($responseMock);

        $client = new AlertApiClient(123, $curlMock);
        $requestMock = $this->createMock(CloseAlertRequest::class);
        $requestMock->expects($this->once())->method('getBody')->willReturn([]);

        $this->assertInstanceOf(CloseAlertResponse::class, $client->closeAlert($requestMock));
    }

    public function testGetFailedResponseOnError()
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->method('getStatusCode')->willReturn(500);
        $responseMock->method('getBody')->willReturn("{}");

        $badResponseMock = $this->createMock(BadResponseException::class);
        $badResponseMock->expects($this->once())->method('getResponse')->willReturn($responseMock);

        $curlMock = $this->createMock(\GuzzleHttp\Client::class);
        $curlMock->expects($this->once())->method('request')
            ->willThrowException($badResponseMock);

        $client = new AlertApiClient(123, $curlMock);
        $requestMock = $this->createMock(CloseAlertRequest::class);
        $this->assertInstanceOf(CloseAlertResponse::class, $client->closeAlert($requestMock));
    }

    public function testCreateForEUApi()
    {
        $this->assertInstanceOf(AlertApiClient::class, AlertApiClient::createForEUApi(123));
    }

    public function testCreateForUSApi()
    {
        $this->assertInstanceOf(AlertApiClient::class, AlertApiClient::createForUSApi(123));
    }
}
