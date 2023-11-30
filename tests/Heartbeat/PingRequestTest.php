<?php
/**
 * This File is part of JTL-Software
 *
 * User: rherrgesell
 * Date: 3/15/19
 */

namespace JTL\OpsGenie\Client\Heartbeat;

use PHPUnit\Framework\TestCase;

/**
 * Class PingRequestTest
 * @covers \JTL\OpsGenie\Client\Heartbeat\PingRequest
 */
class PingRequestTest extends TestCase
{
    public function testHttpMethodIsPut(): void
    {
        $request = new PingRequest('dingens');
        $this->assertEquals('PUT', $request->getHttpMethod());
    }

    public function testBodyIsEmpty(): void
    {
        $request = new PingRequest('dingens');
        $this->assertEquals([], $request->getBody());
    }

    public function testGetUrl(): void
    {
        $request = new PingRequest('url-foo-bar');
        $this->assertEquals('heartbeats/url-foo-bar/ping', $request->getUrl());
    }
}
