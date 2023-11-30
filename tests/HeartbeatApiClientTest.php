<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 3/15/19
 */

namespace JTL\OpsGenie\Client;

use JTL\OpsGenie\Client\Heartbeat\PingRequest;
use JTL\OpsGenie\Client\Heartbeat\PingResponse;
use PHPUnit\Framework\TestCase;

/**
 * Class HeartbeatApiClientTest
 * @covers \JTL\OpsGenie\Client\HeartbeatApiClient
 */
class HeartbeatApiClientTest extends TestCase
{
    public function testSendPing(): void
    {

        $clientMock = $this->createMock(HttpClient::class);
        $clientMock->expects($this->once())
            ->method('request')
            ->willReturn($this->createMock(PingResponse::class));
        $requestMock = $this->createMock(PingRequest::class);

        $api = new HeartbeatApiClient($clientMock);
        $_ = $api->sendPing($requestMock);
        $this->assertInstanceOf(PingResponse::class, $_);
    }
}
